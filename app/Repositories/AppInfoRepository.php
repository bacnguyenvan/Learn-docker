<?php

namespace App\Repositories;

use App\Contracts\AppInfoContract;
use App\Models\AppInfo;
use App\Traits\ResponseAPI;

class AppInfoRepository  implements AppInfoContract
{
    use ResponseAPI;

    /**
     * Show app info
     * @return json
     */
    public function show()
    {
        try {
            $app = AppInfo::all()->last();
            if ($app) {
                return $this->success('Get app success', \App\Http\Resources\AppInfoResource::make($app), 200);
            } else {
                throw new \App\Exceptions\AppInfoLastNotFoundException;
            }
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * Create app info by name and request body
     * @param \App\Http\Requests\AppInfoPutRequest
     */
    public function store($request)
    {
        try {
            $info = AppInfo::create($request->all());

            return $this->success('Update app success', \App\Http\Resources\AppInfoResource::make($info), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     *
     */
    public function destroy($name)
    {
        //
    }
}
