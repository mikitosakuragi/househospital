<?php

namespace App\Models;

use App\Models\Like;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\User;   //Userモデルを使用

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class topic extends Model
{
    // use HasFactory;

    //テーブル
    protected $table = 'topics';
    //id
    protected $primaryKey = 'id';

    protected $fillable = 
    [
        'id',
        'user_id',
        'name',
        'title',
        'pic_main',
        'pic_sub1',
        'pic_sub2',
        'content',
        'created_at',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    //後でViewで使う、いいねされているかを判定するメソッド
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('topic_id', $this->id)->first() !==null;
    }

    //1054 Unknown column 'updated_at' in 'field list'エラー対策
    public $timestamps = false ;
}
