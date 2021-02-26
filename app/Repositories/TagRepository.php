<?php

namespace App\Repositories;

use App\Contracts\TagContract;
use App\Models\Tag;
use App\Traits\ResponseAPI;

class TagRepository  implements TagContract
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
            $tags = Tag::all();

            return $this->success('Get tag success', \App\Http\Resources\TagResource::collection($tags), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $tag
     * @return void
     */
    public function show($tag)
    {
        try {
            return $this->success('Get tag success', \App\Http\Resources\TagResource::make($tag), 200);
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
            $tag = Tag::create($request->all());

            return $this->success('Insert tag success', \App\Http\Resources\TagResource::make($tag), 200);
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
    public function update($request, $tag)
    {
        try {
            foreach ($request->all() as $key => $value) {
                $tag[$key] = $value;
            }
            $tag->save();

            return $this->success('Update tag success', \App\Http\Resources\TagResource::make($tag), 200);
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
    public function destroy($tag)
    {
        try {
            $tag->delete();

            return $this->success('Delete tag success', \App\Http\Resources\TagResource::make($tag), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
