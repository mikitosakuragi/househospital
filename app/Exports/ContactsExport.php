<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ContactsExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::select(
            'id',
            'name', 
            'kana', 
            'tel', 
            'email',
            'contactway',
            'title',
            'content',
            'created_at'
        )->get();

        $sheet->setAutoSize(true);

        $sheet->getStyle('A1:K3')->applyFromArray([
            'borders' => [ 'allborders' => [ 'style' => \PHPExcel_Style_Border::BORDER_THIN ] ]
          ]);
    }


    public function headings():array{
        return[
            // 'id',
            // 'name', 
            // 'kana', 
            // 'tel', 
            // 'email',
            // 'contactway',
            // 'title',
            // 'pic_main',
            // 'pic_sub1',
            // 'pic_sub2',
            // 'content',
            // 'created_at'
            'id',
            '名前', 
            'フリガナ', 
            '電話番号', 
            'メール',
            '希望連絡方法',
            'タイトル',
            '内容',
            '登録日時'
        ];
    }
}
