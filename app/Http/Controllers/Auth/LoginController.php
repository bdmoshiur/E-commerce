<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller
{

    public function login(Request $request){
        $request->validate([
                'email' => 'required',
                'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $validData = User::where('email',$email)->first();
        $password_check = password_verify($password, @$validData->password);

        if($password_check == false){
            return redirect()->back()->with('message','Email or password dose not match!');
        }
        if($validData->status == '0'){
            return redirect()->back()->with('message','Sorry! you are not varified yet!');
        }

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            
            return redirect()->route('login');
        }
    }

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
