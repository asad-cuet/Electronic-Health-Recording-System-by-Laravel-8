<?php

namespace App\Exports;

use App\Models\Prescribe;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PrescribeExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'consultation_id',
            'title',
            'comment',
            'isAllow',
            'created_at',
            'updated_at'
        ];
    }
    public function collection()
    {
        return collect(Prescribe::getPrescribe());
    }
}
