<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prescribe extends Model
{
    use HasFactory;
    protected $table='prescribes';
    protected $fillable=[
        'consultation_id',
        'title',
        'comment',
        'isAllow'
    ];

    public static function getPrescribe()
    {
    $records=DB::table('prescribes')->get()->toArray();
    return $records;
    }
}
