<?php

namespace App\Repositories;

use App\Contracts\NotificationContract;
use App\Traits\ResponseAPI;

class NotificationRepository  implements NotificationContract
{
    use ResponseAPI;

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        try {
            $notifications = \App\Models\Notification::all();

            return $this->success('Get notification success', \App\Http\Resources\NotificationResource::collection($notifications), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $notification
     * @return void
     */
    public function show($notification)
    {
        try {
            return $this->success('Get notification success', \App\Http\Resources\NotificationResource::make($notification), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store($request)
    {
        try {
            $notification = \App\Models\Notification::create($request->all());

            return $this->success('Insert notification success', \App\Http\Resources\NotificationResource::make($notification->fresh()), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update($request, $notification)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $notification[$key] = $value;
            }
            $notification->save();

            return $this->success('Update notification success', \App\Http\Resources\NotificationResource::make($notification->fresh()), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($notification)
    {
        try {
            $notification->delete();

            return $this->success('Delete notification success', \App\Http\Resources\NotificationResource::make($notification), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
