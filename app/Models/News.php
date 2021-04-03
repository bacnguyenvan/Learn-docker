<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use  HasFactory, SoftDeletes;

    const STATUS_PUBLIC = 1;

    protected $dates = ['release_time'];
    protected $guarded = [
        'deleted_at',
    ];
    protected $hidden = ['pivot'];

    public function getAllByMember($member_id)
    {
        return $this->leftJoin('member_news', function ($join) use ($member_id) {
            $join->on('member_news.news_id', '=', 'news.id')
                ->where('member_id', $member_id);
        })
        ->where('is_public', self::STATUS_PUBLIC)
        ->select('news.id AS news_id', 'news.is_public', 'news.title', 'news.content', 'news.policy',
            'news.thumbnail', 'news.release_time', 'news.created_at', 'news.updated_at',
            'member_news.id', 'member_news.read_at', 'member_news.member_id');
    }

    public function getUnreadCountByMember($member_id)
    {
        return $this->getAllByMember($member_id)
            ->whereNull('member_news.member_id')
            ->count();
    }
}
