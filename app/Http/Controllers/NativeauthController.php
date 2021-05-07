<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Session;

class NativeauthController extends Controller
{
    public function validasilogin(Request $request)
    {
        // this code validate login
        $this->validate($request,

            ['username'=>'required'],

            ['password'=>'required']

        );

        $user = $request->input('username');
        $pass = $request->input('password');

        // this code check user and pass in database

        $users = DB::table('users')->where(['username'=> $user])->first();
        $encryp = md5($pass);

               // if result in input form and result query valid create token and redirect to dashboard
               // else redirect to form login again and login failed

                if($users != null AND $users->username == $user AND $users->password =  $encryp ){
                  $token = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(20/strlen($x)) )),1,20);
                  // this code update token in user valid
                  DB::table('users')
                  ->where('username',$user)
                  ->update([
                      'token' => $token,
                  ]);
                  Session::put('token', $token);
                  $session =  Session::get('token');
                   return redirect('/');

                } else {


                   return redirect('/')->with('message','Login gagal');

                }
    }

    public function logout()
    {
      DB::table('users')
      ->update([
          'token' => '',
      ]);
      $session =  Session::remove('token');
       return redirect('/');

    }


}
