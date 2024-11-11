<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Doctor extends Model
{
    use HasFactory;
    protected $table='doctors';
    protected $fillable=[
        'user_id',
        'password',
        'phone',
        'department_id',
        'specialization',
        'qualification'
    ];

    public function consultation()  //making relationship
    {
         return $this->belongsTo(Doctor::class,'consulted_by','id');
    }
    public function user()  //making relationship
    {
         return $this->belongsTo(User::class,'user_id','id');
    }
    public function department()  //making relationship
    {
         return $this->belongsTo(Department::class,'department_id','id');
    }
    public static function getDoctor()
    {
    $records=DB::table('doctors')->select(
     'id',
     'user_id',
     'phone',
     'department_id',
     'specialization',
     'qualification',     
     'created_at',     
     'updated_at'     
    )->get()->toArray();
    return $records;
    }
}
