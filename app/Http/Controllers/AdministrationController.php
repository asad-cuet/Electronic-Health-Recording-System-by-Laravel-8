<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdministrationController extends Controller
{
    public function all_user()
    {
        $user=User::where('role_as','!=','doctor')->orderBy('created_at','desc')->get();
        $user=collect($user)->map(function($item,$key)
        {
            return [
                'id'=>$item['id'],
                'name'=>$item['name'],
                'email'=>$item['email'],
                'role_as'=>$item['role_as']
                ];
        });
        return view('pages.user.user_list',['user'=>$user]);
    }

    public function delete_user($user_id)
    {
        $user =User::find($user_id);
        if($user->role_as=='doctor')
        {
            return back()->with('danger',"Doctor can't be deleted");
        }
        //dd('sss');
        $user->delete();
        return back()->with('status',"User deleted Successfully");
    }
}
