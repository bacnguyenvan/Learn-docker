<?php

namespace App\Models;

use App\Http\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MemberNews extends Model
{
    use  HasFactory, SoftDeletes;

    protected $fillable = [
        'member_id',
        'news_id',
        'read_at',
    ];
    protected $table = 'member_news';
    protected $hidden = ['pivot'];
    protected $with = ['news'];
    public $timestamps = FALSE;

    public function news()
    {
        return $this->belongsTo('App\Models\News')->setEagerLoads([]);
    }

    public function prepForResource()
    {
        $re = $this->toArray();
        unset($re['news']);

        $news = $this->news;
        $re = array_merge($re, [
            'news_id' => $news['id'],
            'title' => $news['title'],
            'content' => $news['content'],
            'thumbnail' => $news->thumbnail,
            'is_public' => $news['is_public'],
            'policy' => $news['policy'],
            'release_time' => $news['release_time'],
            'created_at' => $news['created_at'],
            'updated_at' => $news['updated_at'],
        ]);

        return (object) $re;
    }
}
