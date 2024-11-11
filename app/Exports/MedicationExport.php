<?php

namespace App\Exports;

use App\Models\Medication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MedicationExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'patient_id',
            'medication',
            'dose',
            'route',
            'frequency',
            'last_taken',
            'created_at',
            'updated_at'
        ];
    }
    public function collection()
    {
        return collect(Medication::getMedication());
    }
}
