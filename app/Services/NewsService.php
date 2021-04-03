<?php

namespace App\Services;

use App\Http\Helpers\Helper;
use App\Http\Resources\MemberNewsResource;
use App\Http\Resources\NewsResource;
use App\Models\MemberNews;
use App\Models\News;
use App\QueryFilters\Limit;
use App\QueryFilters\ReleaseTime;
use App\QueryFilters\OrderBy;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class NewsService
{
    private $member_news;

    public function __construct(MemberNews $member_news)
    {
        $this->member_news = $member_news;
    }

    public function getInputs($request)
    {
        $inputs = [
            'title' => $request->title,
            'content' => $request->content,
            'is_public' => $request->is_public,
            'policy' => $request->policy,
            'release_time' => $request->release_time,
        ];
        if ($request->hasFile('thumbnail')) {
            $filePath = Helper::newsImagePath;
            $file = $request->thumbnail;

            $fileName = $filePath . $file->getClientOriginalName();
            $file->move($filePath, $fileName);
            $inputs['thumbnail'] = $fileName;
        }

        return $inputs;
    }

    public function getNewsListByMember(Request $request, $member_id, $appends = [])
    {
        try {
            if (!$request->query('order_by')) {
                $request->merge(['order_by' => 'release_time,desc']);
            }

            $all_news = app(News::class)->getAllByMember($member_id);
            $all_news = app(Pipeline::class)
                ->send($all_news)
                ->through([
                    ReleaseTime::class,
                    OrderBy::class,
                    Limit::class,
                ])
                ->thenReturn();

            if ($request->query('limit')) {
                $data = $all_news->get();
            } else {
                $data = $all_news->paginate(config('api.news.limit'));
            }

            return MemberNewsResource::collection($data)
                ->additional($appends)
                ->toResponse(request())
                ->getData(true);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function getNewsByMember($news_id, $member_id)
    {
        try {
            if (empty($member_id)) {
                $mem_news = $this->member_news->newInstance([
                    'member_id' => null,
                    'news_id' => $news_id,
                ]);
            } else {
                $mem_news = $this->setNewsRead($member_id, $news_id);
            }

            return MemberNewsResource::make($mem_news->prepForResource());
        } catch (\Exception $error) {
            throw $error;
        }

        return [];
    }

    protected function setNewsRead($member_id, $news_id)
    {
        $re = $this->member_news->firstOrCreate([
            'member_id' => $member_id,
            'news_id' => $news_id,
        ]);

        return $re->fresh();
    }

    public function getNewsListAdmin(Request $request)
    {
        try {
            // if (!$request->query('order_by')) {
            //     $request->merge(['order_by' => 'release_time,desc']);
            // }

            $all_news = app(Pipeline::class)
                ->send(News::query())
                ->through([
                    OrderBy::class,
                    Limit::class,
                ])
                ->thenReturn();

            if (trim($request->query('limit')) !== '') {
                $data = $all_news->get();
            } else {
                $data = $all_news->paginate(config('api.news.limit'));
            }

            return NewsResource::collection($data)
                ->toResponse(request())
                ->getData(true);

        } catch (\Exception $error) {
            throw $error;
        }
    }
}
