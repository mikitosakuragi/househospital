<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;
use Illuminate\Support\Facades\DB; 

class ContactsController extends Controller
{
    public function export(){

        return Excel::download(new ContactsExport, 'contacts.xlsx');

	    // // 出力データ取得
        // $contacts = DB::table('contacts')->get();

        // // Excel 定義
        // Excel::Store('contacts', function($excel) use($contacts) {
        // // Sheets 定義
        // $excel->sheet('WorkSheet', function($sheet) use($contacts) {
        //     // 列幅指定なし
        //     $sheet->setAutoSize(true);
        //     // ヘッダ定義
        //     $header = array(
        //     'id',
        //     'name', 
        //     'kana', 
        //     'tel', 
        //     'email',
        //     'contactway',
        //     'title',
        //     'pic_main',
        //     'pic_sub1',
        //     'pic_sub2',
        //     'content',
        //     'created_at');
        //     // 出力データ配列に追加
        //     $data = array($header);
        //     // 明細行
        //     foreach($contacts as $contact) {
        //         array_push($data,
        //         array($contact->id,
        //         $contact->name, 
        //         $contact->kana, 
        //         $contact->tel, 
        //         $contact->email,
        //         $contact->contactway,
        //         $contact->title,
        //         $contact->pic_main,
        //         $contact->pic_sub1,
        //         $contact->pic_sub2,
        //         $contact->content,
        //         $contact->created_at)
        //         );
        //     }
        //     // A1に配列データを突っ込む
        //     $sheet->fromArray($data, NULL, 'A1', false, false);
        // });
        // })->download('xlsx');

    }

}
