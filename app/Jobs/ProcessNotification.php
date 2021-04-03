<?php

namespace App\Jobs;

use App\Repositories\NotificationRepository;
use Carbon\CarbonImmutable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private NotificationRepository $repo;
    private $notification_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(NotificationRepository $repo, ?int $notification_id = null)
    {
        $this->repo = $repo;
        $this->notification_id = $notification_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notifications = $this->repo->fetchNotifcationsWithUserDevices(now(), null, $this->notification_id);

        return $this->repo->notifyUsers($notifications);
    }
}
