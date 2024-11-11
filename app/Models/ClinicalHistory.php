<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ClinicalHistory extends Model
{
    use HasFactory;
    protected $table='clinical_histories';
    protected $fillable=[
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
        'pain_on_scale'
    ];


    public static function getClinicalHistory()
    {
        $records=DB::table('clinical_histories')->get()->toArray();
        return $records;
    }
}
