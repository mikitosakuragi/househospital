<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use App\Models\User;  //Userモデルを使用
use App\Models\Topic;  //Topicモデルを使用
use App\Models\Contact;  //Contactモデルを使用
use App\Models\like;  //likeモデルを使用
use App\Models\Admin;  //Adminモデルを使用

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    // ログインしていない場合
    public function __construct(){
        $this->middleware('auth');
    }

    //topPage
    public function topPage() { 
        Session::forget('form_inputs');
        $auths = Auth::user();
        return view('topPage', [ 'auths' => $auths ]); 
    }

    // 新規登録完了
    public function index(Request $request){
        $inputs = $request->all(); 
        return view('auth.login');
    }

     // 入力値のバリデーション
     public function confirm(Request $request){
        $request->validate(
            [
                'name'=> 'required', 
                'kana'=> 'required', 
                'tel'=> 'nullable|regex:/^[0-9-]+$/', 
                'email'=> 'required|email',
                'title'=> 'required',
                'pic_main'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
                'pic_sub1'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
                'pic_sub2'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
                'content'=> 'required',
            ],
            [
                'name.required' => '氏名は必須入力です。10文字以内でご入力ください。',
                'kana.required' => 'フリガナは必須入力です。10文字以内でご入力ください。',
                'tel.regex' => '電話番号は0-9の数字のみでご入力ください。',
                'email.required' => 'メールアドレスは必須入力です。',
                'email.email' => 'メールアドレスは正しくご入力ください。',
                'title.required' => 'お問い合わせ内容は必須入力です。20文字以内でご入力ください。',
                'pic_main.required' =>'画像を選択してください。',
                'pic_main.image' =>'指定されたファイルが画像ではありません。',
                'pic_main.mimes' =>'指定された拡張子（PNG/JPG/GIF）ではありません。',
                'pic_main.max' =>'写真のサイズが１Ｍを超えています。',
                'pic_sub1.required' =>'画像を選択してください。',
                'pic_sub1.image' =>'指定されたファイルが画像ではありません。',
                'pic_sub1.mimes' =>'指定された拡張子（PNG/JPG/GIF）ではありません。',
                'pic_sub1.max' =>'写真のサイズが１Ｍを超えています。',
                'pic_sub2.required' =>'画像を選択してください。',
                'pic_sub2.image' =>'指定されたファイルが画像ではありません。',
                'pic_sub2.mimes' =>'指定された拡張子（PNG/JPG/GIF）ではありません。',
                'pic_sub2.max' =>'写真のサイズが１Ｍを超えています。',
                'content.required' => 'お問い合わせ内容は必須入力です。',
            ]
            );

        // $inputs = $request->all();
        $inputs = $request->except([
            'pic_main',
            'pic_sub1',
            'pic_sub2']);

        $pic_main = $request->file('pic_main');
        $pic_sub1 = $request->file('pic_sub1');
        $pic_sub2 = $request->file('pic_sub2');
        // storageファイルに保存、パス変数を取得
        $main_path = $pic_main->store('public/contactPic');
        $sub1_path = $pic_sub1->store('public/contactPic');
        $sub2_path = $pic_sub2->store('public/contactPic');
        // 全体パス
        $read_main_path = str_replace('public/','storage/',$main_path); 
        $read_sub1_path = str_replace('public/','storage/',$sub1_path); 
        $read_sub2_path = str_replace('public/','storage/',$sub2_path); 
        // 変数として確認画面へ渡す
        $data = array(
            'main_path' =>$main_path,
            'sub1_path' =>$sub1_path,
            'sub2_path' =>$sub2_path,

            'read_main_path' => $read_main_path, 
            'read_sub1_path' => $read_sub1_path, 
            'read_sub2_path' => $read_sub2_path, 

        );
        $request->session()->put('data',$data);

        // $pic_main = $request->file('pic_main');
        // $path = $pic_main->store('img','public');
        // Item::create([
        //     'img_path' => $path,
        // ]);

        

       // セッションからフォームの入力値を取得
        Session::put('form_inputs',$inputs); 
        
        // フォームの入力値をセッションに保存
        return view('confirm', ['inputs' => $inputs],['data' => $data]);
    }

    // セッション値の表示
    public function Contact() {
        $contacts = DB::table('contacts')->select(
        'id',
        'name', 
        'kana', 
        'tel', 
        'email',
        'contactway',
        'title',
        'pic_main',
        'pic_sub1',
        'pic_sub2',
        'content',
        'created_at')->get();

        // セッションからフォームの入力値を取得
        $formInputs = Session::get('form_inputs');

        return view('contact', compact('contacts', 'formInputs'));
    }

    // データベースに問い合わせ内容を登録
    public function ContactSend(Request $request) {
        $action = $request->input('action');
        $inputs = $request->except('action');
        if ($action !== 'send') {
            return redirect()
                ->route('contact')
                ->withInput($inputs);
        } else {
            //データベースへ登録
            Contact::create([
                'name' => $inputs['name'],
                'kana' => $inputs['kana'],
                'tel' => $inputs['tel'],
                'email' => $inputs['email'],
                'contactway' => $inputs['contactway'],
                'title' => $inputs['title'],
                'pic_main' => $inputs['pic_main'],
                'pic_sub1' => $inputs['pic_sub1'],
                'pic_sub2' => $inputs['pic_sub2'],
                // 'pic_main' => $data['pic_main'],
                // 'pic_sub1' => $data['read_sub1_path'],
                // 'pic_sub2' => $data['read_sub2_path'],
                'content' => $inputs['content'],
                'created_at' => date("Y-m-d H:i:s")
            ]);
            return view('complete');
        }
    }

    // public function upload(Request $request){
    //     // ディレクトリ名
    //     $dir ='contactpic';

    //     $file_name = $request->file('pic_main')->getClientOriginalName();

    //     $request->file('pic_main')->storeAs('public/'.$dir,$file_name) ;

    //     $file_name = $request->file('pic_sub1')->getClientOriginalName();

    //     $request->file('pic_sub1')->storeAs('public/'.$dir,$file_name) ;

    //     $file_name = $request->file('pic_sub2')->getClientOriginalName();

    //     $request->file('pic_sub2')->storeAs('public/'.$dir,$file_name) ;

    //     return redirect('/');
    // }

    //Topic表示
    public function topicList(Topic $topic , Request $request){
        $topics = DB::table('topics')->select(
          'id',
          'name', 
          'title',
          'pic_main',
          'pic_sub1',
          'pic_sub2',
          'content',
          'created_at')->get();
    
        // セッションからフォームの入力値を取得
        $formInputs = Session::get('form_inputs');

        // いいね機能
        $like=Like::where('topic_id', $topic->id)->where('user_id', auth()->user()->id)->first();
        // いいねカウント機能
        $likes_count = DB::table('likes')
            ->join('topics', 'topics.id', '=', 'likes.topic_id')
            ->select(DB::raw('count(likes.id) AS likes_count'),'topics.id AS topic_id')
            ->groupBy('topics.id')
            ->get();

        return view('topicList', ['topics' => $topics,], ['like' => $like,], ['likes_count' => $likes_count,]);
    
        // return view('topicList', compact('topics', 'formInputs'));
      } 

    // 詳細ページ表示
    public function topicDetail(Request $request, $id) {
    Session::forget('form_inputs');
    $id = $request->id;
    $topics = Topic::where('id',$id)->get();
    return view('topicDetail', ['topics' => $topics]);
    }



    public function logout(){
        Auth::logout();
        return view('auth.logout');
    }

    // public function adminContact(){
    //   return view('adminContact');
    // } 
       

}
