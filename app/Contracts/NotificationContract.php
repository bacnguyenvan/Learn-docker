<?php

namespace App\Contracts;

interface NotificationContract
{
    public function index();
    public function show($notification);
    public function store($request);
    public function update($request, $notification);
    public function destroy($notification);
}
