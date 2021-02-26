<?php

namespace App\Repositories;

use App\Contracts\MemberContract;
use App\Traits\ResponseAPI;
use App\Services\MontbellAPI;
use Illuminate\Pipeline\Pipeline;

class MemberRepository  implements MemberContract
{
    use ResponseAPI;

    private $montbellAPI;

    public function __construct(MontbellAPI $montbellAPI)
    {
        $this->montbellAPI = $montbellAPI;
    }

    /**
     * Show authorization member profile by access key
     */
    public function show($member)
    {
        try {
            $response = $this->montbellAPI->infoMember(request()->header('authorization'));

            unset($response['result_code']);
            unset($response['result_message']);

            $result = array_merge(\App\Http\Resources\MemberResource::make($member)->getAttributes(), $response);

            return $this->success('Get profile success', $result, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * get Stamp List of Member
     *
     * @return void
     */
    public function stamps($member)
    {
        try {
            $stamps = \App\Http\Resources\MemberStampResource::collection(
                $member->member_stamps
            );

            return $this->success('Get stamp list success', $stamps, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function tracks($member)
    {
        try {
            $trackQuery = \App\Models\Track::getTrackByMemberId($member->id);
            $pipeline = app(Pipeline::class)
                ->send($trackQuery)
                ->through([
                    \App\QueryFilters\OrderBy::class,
                    \App\QueryFilters\Limit::class,
                ])
                ->thenReturn();
            $tracks = \App\Http\Resources\MemberTrackResource::collection(
                $pipeline->get()
            );

            return $this->success('Get track list success', $tracks, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function notifications($member)
    {
        try {
            $pipeline = app(Pipeline::class)
                ->send(\App\Models\MemberNotification::getNotificationsByMemberId($member->id))
                ->through([
                    \App\QueryFilters\OrderBy::class,
                ])
                ->thenReturn();

            $notifications = \App\Http\Resources\MemberNotificationResource::collection(
                $pipeline->paginate(config('api.notification.limit'))
            );

            return $this->success('Get notification list success', $notifications->toResponse(request())->getData(true), 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function getNotification($member, $notification)
    {
        try {
            return $this->success('Get notification success', \App\Http\Resources\MemberNotificationResource::make($notification), 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function updateNotification($request, $member, $notification)
    {
        try {
            $notification['read_at'] = $notification['read_at'] != null ? null : now();
            $notification->save();

            return $this->success('Update notification success', $notification, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
