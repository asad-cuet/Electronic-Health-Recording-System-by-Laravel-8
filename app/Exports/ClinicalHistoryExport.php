<?php

namespace App\Exports;

use App\Models\ClinicalHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClinicalHistoryExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'patient_id',
            'primary_admitting_diagnosis',
            'permanant_history',
            'previous_medical_history',
            'surgical_history',
            'smoker',
            'diabetes',
            'heart_rate',
            'bp_systole',
            'bp_diastole',
            'oxygen_seturation',
            'pain_on_scale',
            'created_at',
            'updated_at'
        ];
    }
    public function collection()
    {
        return collect(ClinicalHistory::getClinicalHistory());
    }
}
