<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\User;  //Userモデルを使用
use App\Models\Topic;  //Topicモデルを使用
use App\Models\Image;  //Imageモデルを使用
use App\Models\Like;  //Likeモデルを使用

use Illuminate\Support\Facades\Auth;

class likeController extends Controller
{

//     public function like(Topic $topic, Request $request)
// {
    // $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    // $topic_id = $request->topic_id; //2.投稿idの取得
    // $already_liked = Like::where('user_id', $user_id)->where('topic_id', $topic_id)->first(); //3.

    // if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
    //     $like = new Like; //4.Likeクラスのインスタンスを作成
    //     $like->topic_id = $topic_id; //Likeインスタンスにtopic_id,user_idをセット
    //     $like->user_id = $user_id;
    //     $like->save();
    // } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
    //     Like::where('topic_id', $topic_id)->where('user_id', $user_id)->delete();
    // }
    // //5.この投稿の最新の総いいね数を取得
    // $topic_likes_count = Review::withCount('likes')->findOrFail($topic_id)->likes_count;
    // $param = [
    //     'topic_likes_count' => $topic_likes_count,
    // ];
    // return response()->json($param); //6.JSONデータをjQueryに返す
// }

    // only()の引数内のメソッドはログイン時のみ有効
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only(['like', 'unlike']);
    }

    // いいねをつける
    public function like(Topic $topic, Request $request){
        // $like=New Like();
        // $like->topic_id = $topic->id;
        // $like->user_id = Auth::user()->id;
        // $like->save();

        // return back();
        // Like::create([
        //     'topic_id' => $id,
        //     'user_id' => Auth::id(),
        //   ]);
      
        //   session()->flash('success', 'You Liked the Reply.');
            
        Auth::user()->like($topicId);
        return back();
        // return response(\Illuminate\Http\Response::HTTP_OK);
    }

    // いいねを取り消す
    public function unlike(Topic $topic, Request $request){
        // $user=Auth::user()->id;
        // $like=Like::where('topic_id', $topic->id)->where('user_id', $user)->first();
        // $like->delete();
        // return back();
        Auth::user()->unlike($topicId);
    }

    public function like_users()
    {
            return $this->belongsToMany(User::class,'likes','topic_id','user_id')->withTimestamps();
    }
}
