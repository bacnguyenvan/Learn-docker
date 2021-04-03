<?php

namespace App\Repositories;

use App\Http\Resources\NewsResource;
use App\Contracts\NewsContract;
use App\Models\News;
use App\Traits\ResponseAPI;
use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsRepository  implements NewsContract
{
    use ResponseAPI;
    private $newsService;
    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }
    /**
     * index
     *
     * @return void
     */
    public function index($request)
    {
        try {
            $res = $this->newsService->getNewsListByMember($request, null, ['unread_count' => 0]);
            return $this->successWithMeta('Get news success', $res, 200);

        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function indexAdmin($request)
    {
        try {
            $res = $this->newsService->getNewsListAdmin($request);
            return $this->successWithMeta('Get news success', $res, 200);

        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * show
     *
     * @param  mixed $news
     * @return void
     */
    public function show(Request $request, $news)
    {
        try {
            $res = $this->newsService->getNewsByMember($news->id, $request->member_id);
            return $this->success('Get news success', $res, 200);

        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function showAdmin(Request $request, $news)
    {
        try {
            $res = NewsResource::make($news);
            return $this->success('Get news success', $res, 200);

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
            $inputs = $this->newsService->getInputs($request);
            $inputs['policy'] = $request->policy ?? '';
            $news = News::create($inputs);
            return $this->success('Insert news success', NewsResource::make($news->fresh()), 200);
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
    public function update($request, $news)
    {
        try {
            $inputs = $this->newsService->getInputs($request);
            $inputs['policy'] = $request->policy ?? '';
            $news->update($inputs);

            return $this->success('Update news success', NewsResource::make($news->fresh()), 200);
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
    public function destroy($news)
    {
        try {
            $news->delete();

            return $this->success('Delete news success', NewsResource::make($news), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
