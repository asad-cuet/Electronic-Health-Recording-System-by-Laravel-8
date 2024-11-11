<?php

namespace App\Exports;

use App\Models\Exam;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExamExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'consultation_id',
            'test_id','report',
            'comment_from_lab',
            'comment_from_doctor',
            'is_resent',
            'is_once_sent_to_consult',
            'created_at',
            'updated_at'
        ];
    }
    public function collection()
    {
        return collect(Exam::getExam());
    }
}
