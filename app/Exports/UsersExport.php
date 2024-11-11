<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

 


class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings():array{
        return[
            'id',
            'name',
            'email',
            'role_as',
            'created_at',
            'updated_at'
        ];
    }
    public function collection()
    {
        // return User::all();
        return collect(User::getUser());
    }

}
