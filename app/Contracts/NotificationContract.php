<?php

namespace App\Contracts;

interface NotificationContract
{
    public function index($fetch_all);
    public function show($id);
    public function store(array $request);
    public function update($id, array $request);
    public function destroy($id);
    public function storeFCMToken(array $request);
    public function storeFCMTokenAndSubscribeTopic(array $request, string $topic = '');
    public function notifyUsers($notifications);
    public function sendTestNotification($notification, ?array $fcm_tokens = null);
}
