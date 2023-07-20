<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    // use HasFactory;

    // //テーブル
    // protected $table = 'likes';
    // //id
    // protected $primaryKey = 'id';
    //カラム名
    protected $fillable =
    [
        'id',
        'user_id',
        'topic_id',
        'created_at',
        'updated_at'
    ];
    //1054 Unknown column 'updated_at' in 'field list'エラー対策
    // public $timestamps = false ;


    public function user()
    {   //usersテーブルとのリレーションを定義するlikeメソッド
        return $this->belongsTo(User::class);
    }

    public function topic()
    {   //topicsテーブルとのリレーションを定義するlikeメソッド
        return $this->belongsTo(Topic::class);
    }

    
    //この投稿に対して既にlikeしたかどうかを判別する
    public function isLike($topicId)
    {
        return $this->likes()->where('topic_id',$topicId)->exists();
    }
    
}
