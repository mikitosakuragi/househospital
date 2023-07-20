<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactsController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// 最初にトップ画面を表示
Route::get('/', function () {
    return view('topPage');
});

Route::prefix('/')->group(
    function () {

        //トップページ
        Route::get('/topPage', [HomeController::class, 'topPage'])->name('topPage');

        //入力フォーム
        Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

        //確認フォーム
        Route::post('/confirm', [HomeController::class, 'confirm'])->name('confirm');
        //確認フォームリダイレクト処理
        Route::get('/confirm', function () {
            return redirect()->route('contact');
        });

        //送信完了
        Route::post('/complete', [HomeController::class, 'contactSend'])->name('complete');
        //送信完了リダイレクト処理
        Route::get('/complete', function () {
            return redirect()->route('contact');
        });

        //投稿一覧表示
        Route::get('/topicList', [HomeController::class, 'topicList'])->name('topicList');

        // いいね機能のルート
        // Route::resource('/topicList', [HomeController::class, 'topicList'])->name('topicList');
        Route::get('/topicList/like/{post}', [App\Http\Controllers\LikeController::class, 'like'])->name('like');
        Route::get('/topicList/unlike/{post}', [App\Http\Controllers\LikeController::class, 'unlike'])->name('unlike');

        // Route::post('/topicList/like/{post}', [App\Http\Controllers\LikeController::class, 'like'])->name('like');
        // Route::delete('/topicList/unlike/{post}', [App\Http\Controllers\LikeController::class, 'unlike'])->name('unlike');


        //投稿詳細画面
        Route::get('/topicDetail/{id?}', [HomeController::class, 'topicDetail'])->name('topicDetail');

        

        // メール設定
        // Route::get('/mail', [MailController::class,'index']);
        // Route::post('/mail', [MailController::class,'send']);


        // ログアウト
        // Route::get('/logout', function () {
        //     return redirect()->route('logout');
        // });

        // Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
        
        Route::get('/logout',  [HomeController::class, 'logout'])->name('logout');

        Route::get('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']);
        Route::get('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'showAdminRegisterForm']);

        Route::post('/login/admin', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);
        Route::post('/register/admin', [App\Http\Controllers\Auth\RegisterController::class, 'registerAdmin'])->name('admin-register');

        Route::view('/admin', 'admin')->middleware('auth:admin')->name('admin-home');

        Route::get('password/admin/reset', [App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
        Route::post('password/admin/email', [App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
        Route::get('password/admin/reset/{token}', [App\Http\Controllers\Auth\AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
        Route::post('password/admin/reset', [App\Http\Controllers\Auth\AdminResetPasswordController::class, 'reset'])->name('admin.password.update');

        // Route::get('/adminContact/admin', [App\Http\Controllers\Admin\AdminController::class, 'adminContact'])->name('adminContact');

    }
);

// Route::prefix('admin')->group(
//     function () {
//         //入力フォーム
//         Route::get('/adminContact', [App\Http\Controllers\Admin\AdminController::class, 'adminContact'])->name('adminContact');
//     }
// );

// 管理者権限ページ
Route::middleware('auth:admin')->group(function (){

    //トップページ
    Route::get('/admin', [App\Http\Controllers\Admin\AdminController::class, 'admin'])->name('admin');

    //問合せ一覧表示
    Route::get('/adminContact', [App\Http\Controllers\Admin\AdminController::class, 'adminContact'])->name('adminContact');

    //詳細画面
    Route::get('/adminContactDetail/{id?}', [App\Http\Controllers\Admin\AdminController::class, 'adminContactDetail'])->name('adminContactDetail');

    //削除
    Route::get('/adminContactDelete/{id?}', [App\Http\Controllers\Admin\AdminController::class, 'adminContactDelete'])->name('adminContactDelete');

    //入力フォーム
    Route::get('/adminTopic', [App\Http\Controllers\Admin\AdminController::class, 'adminTopic'])->name('adminTopic');

    //投稿一覧表示
    Route::get('/adminTopicList', [App\Http\Controllers\Admin\AdminController::class, 'adminTopicList'])->name('adminTopicList');

    //編集画面
    Route::get('/adminTopicEdit/{id?}', [App\Http\Controllers\Admin\AdminController::class, 'adminTopicEdit'])->name('adminTopicEdit');
    //編集完了
    Route::post('/adminTopicEditComplete', [App\Http\Controllers\Admin\AdminController::class, 'adminTopicEditSend'])->name('adminTopicEditComplete');

    
    //確認フォーム
    Route::post('/adminTopicConfirm', [App\Http\Controllers\Admin\AdminController::class, 'adminTopicConfirm'])->name('adminTopicConfirm');
    //確認フォームリダイレクト処理
    Route::get('/adminTopicConfirm', function () {
        return redirect()->route('adminTopic');
    });

    //送信完了
    Route::post('/adminTopicComplete', [App\Http\Controllers\Admin\AdminController::class, 'adminTopicSend'])->name('adminTopicComplete');
    //送信完了リダイレクト処理
    Route::get('/adminTopicComplete', function () {
        return redirect()->route('adminTopic');
    });

    //削除
    Route::get('/adminTopicDelete/{id?}', [App\Http\Controllers\Admin\AdminController::class, 'adminTopicDelete'])->name('adminTopicDelete');

    //export
    Route::post('contacts',[ContactsController::class,'export'])->name('export');

    //ログアウト
    // Route::get('/adminLogout', 'App\Http\Controllers\Admin\AdminController@adminLogout');
    Route::get('/adminLogout', [App\Http\Controllers\Admin\AdminController::class, 'adminLogout'])->name('adminLogout');

}
);