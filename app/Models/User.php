<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guard = 'user';
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function likes()
    {
        return $this->hasMany(like::class);
    }
    
    public function topics()
    {
        return $this->hasMany(Topic::class,'likes','user_id','article_id');
    }

    //この投稿に対して既にlikeしたかどうかを判別する
    public function isLike($topicId)
    {
      return $this->likes()->where('topic_id',$topicId)->exists();
    }

    //isLikeを使って、既にlikeしたか確認したあと、いいねする（重複させない）
    public function like($topicId)
    {
      if($this->isLike($topicId)){
        //もし既に「いいね」していたら何もしない
      } else {
        $this->likes()->attach($topicId);
      }
    }

    //isLikeを使って、既にlikeしたか確認して、もししていたら解除する
    public function unlike($topicId)
    {
      if($this->isLike($topicId)){
        //もし既に「いいね」していたら消す
        $this->likes()->detach($topicId);
      } else {
      }
    }

    //1054 Unknown column 'updated_at' in ' field list'エラー対策
    public $timestamps = false ;

}
