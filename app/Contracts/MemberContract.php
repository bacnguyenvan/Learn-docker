<?php

namespace App\Contracts;

use App\Models\Member;
use App\Models\News;
use Illuminate\Http\Request;

interface MemberContract
{
	public function index();
    public function show($member);
    public function stamps($member);
    public function tracks($member);
    public function news(Request $request, $member);
    public function getNews(Member $member, News $news);
    public function updateNews($request, $member, $news);
}
