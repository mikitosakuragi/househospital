<?php

namespace App\Http\Controllers\Admin;

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

class AdminController extends Controller
{

  //topPage
  public function admin() {
    Session::forget('form_inputs');
    $auths = Auth::user();
    return view('admin', [ 'auths' => $auths ]); 
}

  public function adminContact(){
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

    return view('adminContact', compact('contacts', 'formInputs'));
  } 

  // 詳細ページ表示
  public function adminContactDetail(Request $request, $id) {
    Session::forget('form_inputs');
    $id = $request->id;
    // $contacts = Contact::find($id);
    // $contacts = DB::table('contacts')->get();
    $contacts = Contact::where('id',$id)->get();
    // $contacts = Contact::all->first();
    return view('adminContactDetail', ['contacts' => $contacts]);
    // return view('adminContactDetail', compact('contacts'));
  }

  // 削除
  public function adminContactDelete(Request $request) {
    $id = $request->id;
    Contact::where('id', $id)->delete();
    // return redirect()->route('adminContactDelete');
    return view('adminContactDelete');
  }

   // 入力値のバリデーション
   public function adminTopicConfirm(Request $request){
    $request->validate(
      [
        'name'=> 'required', 
        'title'=> 'required',
        'pic_main'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        'pic_sub1'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        'pic_sub2'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
        'content'=> 'required',
    ],
    [
        'name.required' => '氏名は必須入力です。10文字以内でご入力ください。',
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
    ]);

    // $inputs = $request->all();
    $inputs = $request->except([
        'pic_main',
        'pic_sub1',
        'pic_sub2']);

    $pic_main = $request->file('pic_main');
    $pic_sub1 = $request->file('pic_sub1');
    $pic_sub2 = $request->file('pic_sub2');
    // storageファイルに保存、パス変数を取得
    $main_path = $pic_main->store('public/topicPic');
    $sub1_path = $pic_sub1->store('public/topicPic');
    $sub2_path = $pic_sub2->store('public/topicPic');
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

   // セッションからフォームの入力値を取得
    Session::put('form_inputs',$inputs); 
    
    // フォームの入力値をセッションに保存
    return view('adminTopicConfirm', ['inputs' => $inputs],['data' => $data]);
}

// セッション値の表示
public function adminTopic() {
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

    return view('adminTopic', compact('topics', 'formInputs'));
}

// データベースに問い合わせ内容を登録
public function adminTopicSend(Request $request) {
    $action = $request->input('action');
    $inputs = $request->except('action');
    if ($action !== 'send') {
        return redirect()
            ->route('adminTopic')
            ->withInput($inputs);
    } else {
        //データベースへ登録
        Topic::create([
            'name' => $inputs['name'],
            'title' => $inputs['title'],
            'pic_main' => $inputs['pic_main'],
            'pic_sub1' => $inputs['pic_sub1'],
            'pic_sub2' => $inputs['pic_sub2'],
            'content' => $inputs['content'],
            'created_at' => date("Y-m-d H:i:s")
        ]);
        return view('adminTopicComplete');
    }
}

public function adminTopicList(){
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

    return view('adminTopicList', compact('topics', 'formInputs'));
} 

// 編集ページ表示
public function adminTopicEdit(Request $request) {
  Session::forget('form_inputs');
  $id = $request->id;
  $topics = Topic::where('id',$id)->get();
  // $topics = Topic::find($id)->get();
  return view('adminTopicEdit', ['topics' => $topics]);
}

// 編集時のバリデーション
public function adminTopicEditSend(Request $request,Topic $topic) {

  $request->validate(
    [
      'name'=> 'required', 
      'title'=> 'required',
      'pic_main'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
      'pic_sub1'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
      'pic_sub2'=>'required|image|mimes:jpeg,png,jpg,gif|max:1024',
      'content'=> 'required',
  ],
  [
      'name.required' => '氏名は必須入力です。10文字以内でご入力ください。',
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

    // $inputs = $request->except([
    // 'pic_main',
    // 'pic_sub1',
    // 'pic_sub2']);

    // $pic_main = $request->file('pic_main');
    // $pic_sub1 = $request->file('pic_sub1');
    // $pic_sub2 = $request->file('pic_sub2');
    // // storageファイルに保存、パス変数を取得
    // $main_path = $pic_main->store('public/topicPic');
    // $sub1_path = $pic_sub1->store('public/topicPic');
    // $sub2_path = $pic_sub2->store('public/topicPic');
    // // 全体パス
    // $read_main_path = str_replace('public/','storage/',$main_path); 
    // $read_sub1_path = str_replace('public/','storage/',$sub1_path); 
    // $read_sub2_path = str_replace('public/','storage/',$sub2_path); 
    // // 変数として確認画面へ渡す
    //   // if(isset($pic_main)){
    //   //   \Storage::disk('local')->delete($pic_main);
    //   //   $pic_main = $request->file('pic_main');
    //   //   $main_path = $pic_main->store('public/topicPic');
    //   //   $read_main_path = str_replace('public/','storage/',$main_path);
    //   // }

    // $data = array(
    //     'main_path' =>$main_path,
    //     'sub1_path' =>$sub1_path,
    //     'sub2_path' =>$sub2_path,

    //     'read_main_path' => $read_main_path, 
    //     'read_sub1_path' => $read_sub1_path, 
    //     'read_sub2_path' => $read_sub2_path, 

    // );
    // $request->session()->put('data',$data);

  Topic::where('id', $request->id)->update([
      'name' => $request->name,
      'title' => $request->title,
      // 'pic_main' => $request->pic_main,
      // 'pic_sub1' => $request->pic_sub1,
      // 'pic_sub2' => $request->pic_sub2,
      'content' => $request->content,
  ]);

  return view('adminTopicEditComplete');
}

// 削除
public function adminTopicDelete(Request $request) {
  $id = $request->id;
  Topic::where('id', $id)->delete();
  return view('adminTopicDelete');
}



  public function adminLogout(){
    Auth::logout();
    return view('auth.adminLogout');
}
       
}
 