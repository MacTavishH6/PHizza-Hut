<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Users;
use Validator;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{

    public function validateRequest($request){
        $validated = Validator::make($request->all(),[
            'username'=>'required|string|min:5',
            'email'=>'required|email|unique:msusers,Email',
            'password'=>'required|string|min:6|required_with:ConfirmPassword|same:ConfirmPassword',
            'ConfirmPassword'=>'required|string|min:6',
            'address'=>'required|string|min:5',
            'phoneNumber'=>'required|digits_between:5,15',
            'gender'=>'required'
        ]);

        return $validated;
    }


    public function GetListUserDetail(){

        $UsersDetail = Users::all();
        return view('master/User/ViewAllUser',['UsersDetail'=>$UsersDetail]);
    }

    public function Register(Request $request){
    $validated = $this->validateRequest($request);
        if ($validated->fails()) return redirect()->back()->withInput($request->all())->withErrors($validated->errors());
        
        try{
            Users::insert(array(
                'Username' => $request->username,
                'Email' => $request->email,
                'Password' => $request->password,
                'Address' => $request->address,
                'PhoneNumber' => $request->phoneNumber,
                'Gender' => $request->gender,
                'isAdmin' => false,
                'AuditUsername' => "",
                'AuditTime' => Carbon::now()->toDateTimeString(),
                'AuditActivity' => "I"
            ));
            return redirect('/login')->with('status',"Register successfully!");
        }
        catch(Exception $e){
            return redirect('/login')->with('failed',"Error occured when register");
        }

    }

    public function Login(Request $request){

        $credential = $request->only('email','password');
        Auth::attempt($credential);
        
        return redirect('/');
    }

    public function LogOut(){
        Auth::logout();

        return redirect('/login');
    }
}
