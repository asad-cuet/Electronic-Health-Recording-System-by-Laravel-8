<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    protected $table='comments';
    protected $fillable=[
        'consultation_id',
        'exam_id',
        'comment_by_doctor_id',
        'comment'
    ];
    public function doctor()  //making relationship
    {
         return $this->belongsTo(Doctor::class,'comment_by_doctor_id','id');
    }

    public static function getComment()
    {
    $records=DB::table('comments')->get()->toArray();
    return $records;
    }
}
