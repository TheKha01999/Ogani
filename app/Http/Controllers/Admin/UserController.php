<?php

namespace App\Http\Controllers\Admin; //namespace phan biet cac controller cung ten

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = DB::select('select * from users');

        return view('admin.pages.user.list',['users' => $users]);
        // $users = [1, 2, 3, 4, 5];
        // $test = 'aaaaa';
        //Cach 1, dung tham so thu 2 cua ham view de truyen datas
        // return view('admin.pages.user.list',['users' => $users, 'test' => 'Test']);
        //Cach 2, dung ham with
        // return view('admin.pages.user.list')
        //     ->with('users', $users)
        //     ->with('test', 'Test');
        //Cach 3, dung ham compact thi chi can truyen key no tu di kiem bien ung voi key
        // return view('admin.pages.user.list',compact('users','test'));
    
    }
}
