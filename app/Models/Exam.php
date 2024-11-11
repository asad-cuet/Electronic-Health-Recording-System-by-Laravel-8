<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Exam extends Model
{
    use HasFactory;
    protected $table='exams';
    protected $fillable=[
        'consultation_id',
        'test_id','report',
        'comment_from_lab',
        'comment_from_doctor',
        'is_resent',
        'is_once_sent_to_consult'
    ];

    public function test()  //making relationship
    {
         return $this->belongsTo(Test::class);
    }

    public static function getExam()
    {
    $records=DB::table('exams')->get()->toArray();
    return $records;
    }
}
