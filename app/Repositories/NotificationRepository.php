<?php

namespace App\Repositories;

use App\Contracts\NotificationContract;
use App\Helpers\Log as Logger;
use App\Http\Helpers\Helper;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserDeviceResource;
use App\Models\Member;
use App\Models\MemberNotification;
use App\Models\Notification;
use App\Models\UserDevice;
use App\Traits\ResponseAPI;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Kreait\Laravel\Firebase\Facades\Firebase;
use OutOfRangeException;
use Throwable;

class NotificationRepository implements NotificationContract
{
    use ResponseAPI;

    const NOTIFICATION_CHUNK_SIZE = 500;

    private Notification $notification;
    private UserDevice $user_device;
    private MemberNotification $member_notification;
    private Member $member;
    private Logger $logger;
    private Helper $helper;
    private $with = ['member_notifications:notification_id,member_id,status'];

    public function __construct(Notification $notification, UserDevice $user_device, MemberNotification $member_notification, Member $member, Logger $logger, Helper $helper)
    {
        $this->notification = $notification;
        $this->user_device = $user_device;
        $this->member_notification = $member_notification;
        $this->member = $member;
        $this->logger = $logger;
        $this->helper = $helper;
    }

    public function index($fetch_all = false)
    {
        $notification = $this->notification->with($this->with);
        if ($fetch_all) {
            $res = $notification->get();
        } else {
            $per_page = config('pagination.notification.per_page');
            $res = $notification->paginate($per_page);
        }

        return $this->successWithMeta('Store notification successfully.', NotificationResource::collection($res)->response()->getData(true));
    }

    public function show($id)
    {
        $res = $this->notification->with($this->with)->findOrFail($id);
        return $this->success('Find notification success', new NotificationResource($res));
    }

    protected function makeArr($v): array
    {
        return is_array($v) ? $v : [$v];
    }

    protected function isSelectAll(array $conditions): bool
    {
        if (!$this->helper->isEmptyInput($conditions['member_id'])) {
            return false;
        }

        if (
            !$this->helper->isEmptyInput($conditions['prefecture_id'])
            && !in_array('0', $conditions['prefecture_id'], true)
        ) {
            return false;
        }

        return true;
    }

    protected function extractMembers(array $conditions): array
    {
        if (empty($conditions)) {
            throw new InvalidArgumentException('Member extract conditions must not be empty.');
        }

        $query = $this->member->query();

        if ($this->isSelectAll($conditions)) {
            return ['0']; // id = 0 ==> all members
        }

        if ($conditions['member_id']) {
            if (in_array('0', $conditions['member_id'], true)) {
                // no filter needed
            } else {
                $query->whereIn('id', $this->makeArr($conditions['member_id']));
            }
        }

        if ($conditions['prefecture_id']) {
            if (in_array('0', $conditions['prefecture_id'], true)) {
                // no filter needed
            } else {
                $query->whereIn('member_prefecture_id', $this->makeArr($conditions['prefecture_id']));
            }
        }

        return $query->setEagerLoads([])->pluck('id')->toArray();
    }

    protected function getExtractConditionsAsString(array $conditions)
    {
        $re = '';
        foreach ($conditions as $field => $cond) {
            if (!$this->helper->isEmptyInput($cond)) {
                if (is_array($cond)) {
                    $s = implode(',', $cond);
                } else {
                    $s = (string) $cond;
                }
                $re .= sprintf('%s:%s|', $field, $s);
            }
        }

        return rtrim($re, '|');
    }

    protected function getInputsCreateOrUpdate(array $request): array
    {
        $conditions = Arr::only($request, ['all_devices', 'member_id', 'prefecture_id']);
        $notification = Arr::only($request, ['title', 'body', 'delivery_time']);

        return [$conditions, $notification];
    }

    public function store(array $request)
    {
        [$conditions, $data] = $this->getInputsCreateOrUpdate($request);
        $data['member_extract'] = $this->getExtractConditionsAsString($conditions);

        try {
            DB::beginTransaction();
            $noti = $this->notification->create($data);
            $member_noti = [];
            $member_ids = $this->extractMembers($conditions);
            foreach ($member_ids as $m_id) {
                $member_noti[] = [
                    'member_id' => $m_id,
                ];
            }

            $noti->member_notifications()->createMany($member_noti);
            DB::commit();

        } catch (Throwable $e) {
            $this->logger->logError("Store notification error.", $e);
            DB::rollBack();

            return $this->error('Store notification error.', $e->getMessage());
        }

        $noti->load($this->with);

        return $this->success('Store notification successfully.', new NotificationResource($noti));
    }

    public function update($id, array $request)
    {
        [$conditions, $data] = $this->getInputsCreateOrUpdate($request);

        try {
            DB::beginTransaction();
            $noti = $this->notification->findOrFail($id);

            if ($conditions) {
                $data['member_extract'] = $this->getExtractConditionsAsString($conditions);
                $del_rows = $this->member_notification
                    ->where('notification_id', $noti->id)
                    ->where('status', MemberNotification::STATUS_UNSENT)
                    ->delete();

                // if ($del_rows == 0) {
                //     throw new Exception('Already sent notifications cannot be updated.');
                // }

                $member_ids = $this->extractMembers($conditions);
                if ($member_ids) {
                    $member_noti = [];
                    foreach ($member_ids as $m_id) {
                        $member_noti[] = [
                            'member_id' => $m_id,
                        ];
                    }
                    $noti->member_notifications()->createMany($member_noti);
                }
            }

            $noti->update($data);
            DB::commit();

        } catch (Throwable $e) {
            $this->logger->logError("Update notification error.", $e);
            DB::rollBack();

            return $this->error('Update notification error.', $e->getMessage(), 400);
        }

        $noti->load($this->with);

        return $this->success('Update notification successfully.', new NotificationResource($noti));
    }

    public function destroy($id)
    {
        $noti = $this->notification->findOrFail($id);
        $res = new NotificationResource($noti->load($this->with));
        $noti->delete();

        return $this->success('Delete notification successfully.', $res);
    }

    public function storeFCMToken(array $request)
    {
        $res = $this->user_device->updateDeviceInfo(
            $request['device_token'],
            [
                'fcm_token' => $request['fcm_token'],
                'device_agent' => $request['device_agent'] ?? '',
            ]
        );

        return $this->success('Update FCM registration token successfully.', new UserDeviceResource($res));
    }

    public function storeFCMTokenAndSubscribeTopic(array $request, string $topic = '')
    {
        if (empty($topic)) {
            $topic = config('firebase.push_notification.public_topic');
        }
        Firebase::messaging()->subscribeToTopic($topic, $request['fcm_token']);

        return $this->storeFCMToken($request);
    }

    protected function sendMessages(array $message)
    {
        $report = Firebase::messaging()->sendAll($message);
        $success = [];
        $failure = [];
        foreach ($report->getItems() as $item) {
            $_mem_noti_id = $item->message()
                ->jsonSerialize()['data']
                ->jsonSerialize()['_mem_noti_id'];
            if ($item->isSuccess()) {
                $success[] = $_mem_noti_id;
            } else {
                $failure[] = $_mem_noti_id;
            }
        }

        return [
            'success' => $success, 
            'failure' => $failure,
        ];
    }

    protected function batchNotifications($notifications, $chunk_size = 0)
    {
        $messages = [];
        $topic = config('firebase.push_notification.public_topic');
        foreach ($notifications as $noti) {
            $len = count($messages);
            if ($noti->member_id == 0) {
                $messages[$len]['topic'] = $topic;
            } else {
                $messages[$len]['token'] = $noti->fcm_token;
            }
            $messages[$len]['notification'] = [
                'title' => $noti->title,
                'body' => $noti->body,
            ];
            $messages[$len]['data'] = [
                '_mem_noti_id' => $noti->member_notification_id,
            ];

            if (count($messages) == $chunk_size) {
                yield $messages;
                $messages = [];
            }
        }

        if (count($messages)) {
            yield $messages;
        }
    }

    public function notifyUsers($notifications)
    {
        $has_sent = false;
        foreach ($notifications as $chunk) {
            $report = $this->sendMessages($chunk);
            $this->member_notification->whereIn('id', $report['failure'])
                ->update(['status' => MemberNotification::STATUS_ERROR]);
            $this->member_notification->whereIn('id', $report['success'])
                ->update(['status' => MemberNotification::STATUS_SENT]);
            if (!$has_sent) {
                $has_sent = true;
            }
        }

        if ($has_sent) {
            return $this->success('Notifications sent.', null);
        }

        return $this->success('No notification to send.', null);
    }

    public function fetchNotifcationsWithUserDevices(Carbon $delivery_time, ?int $notification_period = null, int $notification_id = null, bool $only_unsent = true)
    {
        $im_delivery_time = $delivery_time->toImmutable()->setSecond(0);
        if (is_null($notification_period)) {
            $notification_period = config('firebase.push_notification.delivery_time_offset_minutes');
        }
        if ($notification_period < 0) {
            throw new OutOfRangeException("Delivery_time offset must be >= 0");
        }

        $query = DB::table('notification')
            ->select('notification.id', 'notification.title', 'notification.body', 'notification.delivery_time',
                'member_notification.id AS member_notification_id', 'member_notification.member_id', 'member_notification.status',
                'user_device.id AS device_id', 'user_device.fcm_token'
            )
            ->join('member_notification', function ($join) use ($notification_id, $im_delivery_time, $notification_period, $only_unsent) {
                $join->on('member_notification.notification_id', '=', 'notification.id')
                    ->whereNull('notification.deleted_at')
                    ->whereNull('member_notification.deleted_at');
                if ($only_unsent) {
                    $join->where('member_notification.status', MemberNotification::STATUS_UNSENT);
                }
                if ($notification_id) {
                    $join->where('notification.id', $notification_id);
                } else {
                    $join->whereBetween('notification.delivery_time', [
                        $im_delivery_time,
                        $im_delivery_time->addMinutes($notification_period),
                    ]);
                }
            })
            ->leftJoin('member_device', 'member_device.member_id', '=', 'member_notification.member_id')
            ->leftJoin('user_device', 'user_device.id', '=', 'member_device.user_device_id')
            ->where(function ($query) {
                $query->where('user_device.fcm_token', '!=', '')
                    ->orWhere('member_notification.member_id', '0');
            });

        return $this->batchNotifications($query->get(), self::NOTIFICATION_CHUNK_SIZE);
    }

    protected function getConfigFCMTokens()
    {
        $tokens = config('firebase.push_notification.send_test_fcm_tokens');
        return explode(',', $tokens);
    }

    public function sendTestNotification($notification, ?array $fcm_tokens = null)
    {
        $fcm_tokens = $fcm_tokens ?? $this->getConfigFCMTokens();
        $messages = [];
        foreach ($fcm_tokens as $token) {
            if (empty($token)) {
                continue;
            }

            $messages[] = [
                'token' => $token,
                'notification' => [
                    'title' => $notification['title'],
                    'body' => $notification['body'],
                ],
                'data' => [
                    '_mem_noti_id' => $token,
                ]
            ];
        }

        if (empty($messages)) {
            return ['No message to sent.'];
        }

        return $this->sendMessages($messages);
    }
}
