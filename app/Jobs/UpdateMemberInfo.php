<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\MontbellAPI;
use App\Models\Member;

class UpdateMemberInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $montbellAPI;
    protected $loginToken;
    protected $member;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(MontbellAPI $montbellAPI,$loginToken,Member $member)
    {
        $this->montbellAPI = $montbellAPI;
        $this->loginToken = $loginToken;
        $this->member = $member;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // update member   
        $dataMember = $this->montbellAPI->getMemberInfo($this->loginToken);
        $this->member->update($dataMember);
    }
}
