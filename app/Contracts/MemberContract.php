<?php

namespace App\Contracts;

interface MemberContract
{
    public function show($member);
    public function stamps($member);
    public function tracks($member);
    public function notifications($member);
    public function getNotification($member, $notification);
    public function updateNotification($request, $member, $notification);
}
