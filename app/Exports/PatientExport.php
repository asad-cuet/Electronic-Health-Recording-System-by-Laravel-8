<?php

namespace App\Exports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings; 

class PatientExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'pre_name',
            'fname',
            'lname',
            'full_name',
            'gender',
            'age',
            'height',
            'weight',
            'address',
            'phone',
            'health_insurance',
            'guardian_name',
            'guardian_phone',
            'relationship',
            'history_id',
            'is_consulted',
            'is_cleared',
            'created_at',
            'updated_at'
        ];
    }
    public function collection()
    {
        // return User::all();
        return collect(Patient::getPatient());
    }
}
