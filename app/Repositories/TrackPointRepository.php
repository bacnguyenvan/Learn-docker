<?php

namespace App\Repositories;

use App\Contracts\TrackPointContract;
use App\Models\TrackPoint;
use App\Traits\ResponseAPI;

class TrackPointRepository  implements TrackPointContract
{
    use ResponseAPI;

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store($request)
    {
        try {
            $point = TrackPoint::create($request->all());

            return $this->success('Insert track point success', $point, 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
