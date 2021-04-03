<?php

namespace App\Repositories;

use App\Contracts\BadgeContract;
use App\Traits\ResponseAPI;
use App\Models\Badge;
use App\Http\Resources\BadgeResource;

class BadgeRepository implements BadgeContract
{
    use ResponseAPI;
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $badges = Badge::all();

        return $this->success('Get badges success', BadgeResource::collection($badges), 200);
    }

    public function show($badge)
    {
        try {
            return $this->success('Get badge success', BadgeResource::make($badge), 200);
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

            $inputs = $this->getInputs($request);
            $badge = Badge::create($inputs);
            
            return $this->success('Insert area success', BadgeResource::make($badge), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $area
     * @return void
     */
    public function update($request, $area)
    {
        try {
            $inputs = $this->getInputs($request);
            $area->update($inputs);
            return $this->success('Update badge success', BadgeResource::make($area), 200);
        } catch (\Exception $err) {
            throw $err;
        }        
    }

    /**
     * destroy
     *
     * @param  mixed $area
     * @return void
     */
    public function destroy($badge)
    {
        try {
            $badge->delete();
            return $this->success('Delete badge success', BadgeResource::make($badge), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function getInputs($request)
    {
        $inputs = [
            'type' => $request->type
        ];

        if($request->hasFile('thumbnail')){
            $file = $request->thumbnail;
            
        }
        return $inputs;

    }
}
