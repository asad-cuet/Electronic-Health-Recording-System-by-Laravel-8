<?php

namespace App\Exports;

use App\Models\Comment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CommentExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'consultation_id',
            'exam_id',
            'comment_by_doctor_id',
            'comment',
            'created_at',     
            'updated_at'  
        ];
    }
    public function collection()
    {
        return collect(Comment::getComment());
    }
}
