<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DepartmentExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'id',
            'name',    
            'created_at',     
            'updated_at'  
        ];
    }
    public function collection()
    {
        return collect(Department::getDepartment());
    }
}
