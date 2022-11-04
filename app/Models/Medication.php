<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Medication extends Model
{
    use HasFactory;
    protected $table='medications';
    protected $fillable=[
        'patient_id',
        'medication',
        'dose',
        'route',
        'frequency',
        'last_taken'
    ];

    public static function getMedication()
    {
        $records=DB::table('medications')->get()->toArray();
        return $records;
    }
}
