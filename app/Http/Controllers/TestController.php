<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;


class TestController extends Controller
{
    public function tests()
    {
        $tests=Test::orderBy('id','desc')->get();
        return view('pages.test.test_list',['tests'=>$tests]);

    }
    public function test_form()
    {
        return view('pages.test.test_form');

    }

    public function add_test(Request $request)
    {
        if(Test::where('test_name',$request->input('test_name'))->exists())
        {
            return back()->with('danger',"Named ".$request->input('test_name')." already exist");
        }
        $data=[
            'test_name'=>$request->input('test_name')
        ];
        Test::create($data);
        return redirect(route('tests'))->with('status','Test Added Successfully');

    }
}
