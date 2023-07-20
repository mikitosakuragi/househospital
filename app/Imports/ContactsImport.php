<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;

class ContactsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Contact([
            'id'=>$row['id'],
            'name'=>$row['name'],
            'kana'=>$row['kana'],
            'tel'=>$row['tel'],
            'email'=>$row['email'],
            'contactway'=>$row['contactway'],
            'title'=>$row['title'],
            'content'=>$row['content'],
            'created_at'=>$row['created_at'],
        ]);
    }
}
