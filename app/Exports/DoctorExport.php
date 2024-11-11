<?php

namespace App\Exports;

use App\Models\Doctor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DoctorExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'user_id',
            'phone',
            'department_id',
            'specialization',
            'qualification',     
            'created_at',     
            'updated_at'  
        ];
    }
    public function collection()
    {
        return collect(Doctor::getDoctor());
    }
}
