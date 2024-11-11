<?php

namespace App\Exports;

use App\Models\consultation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsultationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'patient_id',
            'consulted_by',   //doctor_id
            'department_id',   //doctor's department_id
            'problem_details',
            'problem_duration',
            'is_examed',
            'is_on_exam',
            'exam_result',
            'is_complete',
            'created_at',
            'updated_at'
        ];
    }
    public function collection()
    {
        return collect(consultation::getConsultation());
    }
}
