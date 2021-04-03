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

    public function listTagsActive()
    {
        try {
            $tags = Tag::getListTagsActive();

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
            $inputs = $this->getInputs($request);
            $tag = Tag::create($inputs);

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
            $inputs = $this->getInputs($request);
            $tag->update($inputs);

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

    public function getInputs($request)
    {
        $inputs = [
            'name' => $request->input('name'),
            'column_space' => $request->column_space,
            'is_keyword' => $request->is_keyword
        ];

        return $inputs;
    }
}
