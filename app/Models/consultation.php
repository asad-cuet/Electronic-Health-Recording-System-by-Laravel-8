<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class consultation extends Model
{
    use HasFactory;
    protected $table='consultations';
    protected $fillable=[
        'patient_id',
        'consulted_by',   //doctor_id
        'department_id',   //doctor's department_id
        'problem_details',
        'problem_duration',
        'is_examed',
        'is_on_exam',
        'exam_result',
        'is_complete'
    ];
    public function patient()  //making relationship
                {
                     return $this->belongsTo(Patient::class,'patient_id','id');
                }
    public function doctor()  //making relationship
                {
                     return $this->belongsTo(Doctor::class,'consulted_by','id');
                }
    public function prescribe()  //making relationship
                {
                     return $this->hasMany(Prescribe::class);
                }
    public function exam()  //making relationship
                {
                     return $this->hasMany(Exam::class,'id','consultation_id');
                }

     public static function getConsultation()
     {
     $records=DB::table('consultations')->get()->toArray();
     return $records;
     }
}
