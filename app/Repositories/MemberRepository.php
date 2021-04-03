<?php

namespace App\Repositories;

use App\Contracts\MemberContract;
use App\Http\Helpers\Helper;
use App\Jobs\UpdateMemberInfo;
use App\Models\Member;
use App\Models\MemberNews;
use App\Models\News;
use App\Traits\ResponseAPI;
use App\Services\MontbellAPI;
use App\Services\NewsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class MemberRepository  implements MemberContract
{
    use ResponseAPI;

    private $montbellAPI;
    private $member_news;
    private $news_service;

    public function __construct(MontbellAPI $montbellAPI, MemberNews $member_news, NewsService $news_service)
    {
        $this->montbellAPI = $montbellAPI;
        $this->member_news = $member_news;
        $this->news_service = $news_service;
    }

    /**
     *   Show all members
     */
    public function index()
    {
        try {
            $members = \App\Models\Member::all();

            return $this->success('Get members success', \App\Http\Resources\MemberResource::collection($members), 200);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    /**
     * Show authorization member profile by access key
     */
    public function show($member)
    {
        try {
            $response = $this->montbellAPI->infoMember(request()->header('authorization'));

            unset($response['result_code']);
            unset($response['result_message']);

            dispatch(new UpdateMemberInfo($this->montbellAPI, request()->header('authorization'), $member));

            $result = array_merge(\App\Http\Resources\MemberResource::make($member)->getAttributes(), $response);

            return $this->success('Get profile success', $result, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    /**
     * get Stamp List of Member
     *
     * @return void
     */
    public function stamps($member)
    {
        try {
            $stamps = \App\Http\Resources\MemberStampResource::collection(
                $member->member_stamps
            );

            return $this->success('Get stamp list success', $stamps, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function tracks($member)
    {
        try {
            $trackQuery = \App\Models\Track::getTrackByMemberId($member->id);
            $pipeline = app(Pipeline::class)
                ->send($trackQuery)
                ->through([
                    \App\QueryFilters\OrderBy::class,
                    \App\QueryFilters\Limit::class,
                ])
                ->thenReturn();

            $resources = \App\Http\Resources\MemberTrackResource::collection(
                $pipeline->get()
            );

            $trackList = Helper::getActivityStatistics($resources);

            return $this->success('Get track list success', $trackList, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function news(Request $request, $member)
    {
        try {
            $unread_count = app(News::class)->getUnreadCountByMember($member->id);
            $res = $this->news_service->getNewsListByMember($request, $member->id, ['unread_count' => $unread_count]);
            return $this->successWithMeta('Get news list success', $res, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    public function getNews(Member $member, News $news)
    {
        try {
            $res = $this->news_service->getNewsByMember($news->id, $member->id);
            return $this->success('Get news success', $res, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }

    protected function setNewsRead(Member $member, News $news)
    {
        $re = $this->member_news->firstOrCreate([
            'member_id' => $member->id,
            'news_id' => $news->id,
        ]);

        return $re->fresh();
    }

    public function updateNews($request, $member, $news)
    {
        try {
            $news['read_at'] = $request['read_at'] ? Carbon::createFromFormat('Y-m-d H:i:s', $request['read_at']) : now();
            $news->save();

            return $this->success('Update news success', $news, 200);
        } catch (\Exception $error) {
            throw $error;
        }
    }
}
