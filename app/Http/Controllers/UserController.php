<?php

namespace App\Http\Controllers;

use App\Users;


class UserController extends Controller
{
    public function GetListUserDetail(){

        $UsersDetail = Users::all();
        return view('master/User/ViewAllUser',['UsersDetail'=>$UsersDetail]);
    }
}
