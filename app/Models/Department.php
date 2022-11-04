<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    use HasFactory;
    protected $table='departments';
    protected $fillable=[
        'name'
    ];

    public static function getDepartment()
    {
    $records=DB::table('departments')->get()->toArray();
    return $records;
    }
}
