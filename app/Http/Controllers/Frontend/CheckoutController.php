<?php

namespace App\Http\Controllers\Frontend;


use App\User;
use App\Model\Logo;
use App\Model\Contact;
use App\Model\Shipping;
use PhpParser\Builder\Use_;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function customerLogin(){

         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
        return view('frontend.single_pages.customer-login',$data);
    }


     public function customerSignup(){

         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
        return view('frontend.single_pages.customer-signup',$data);
    }

    public function signupStore(Request $request){
            DB::transaction(function () use($request) {
                    $request->validate([
                        'name' => 'required',
                        'email' => 'required|unique:users,email',
                        'mobile' => ['required','unique:users,mobile', 'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/'],
                        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                        'password_confirmation' => 'min:8'
                    ]);
                    $code  = rand(0000,9999);
                    $user = new User();
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->mobile = $request->mobile;
                    $user->address = $request->address;
                    $user->password = bcrypt($request->password);
                    $user->code = $code;
                    $user->status = '0';
                    $user->usertype = 'customer';
                    $user->save();

                    $data = array(
                        'email' => $request->email,
                        'code' => $code,
                    );
                    Mail::send('frontend.emails.verify-email', $data, function ($message) use($data) {
                        $message->from('moshiurcse888@gmail.com', 'shpmosmo');
                        $message->to($data['email'],'Moshiur');
                        $message->subject('Please verify your email address');
                    });
            });

            return redirect()->route('email.verify')->with('success','you have successfully sign up ! please verifiy your email');
        }



        public function emailVerify(){
            $data['logo'] = Logo::first();
            $data['contact'] = Contact::first();
            return view('frontend.single_pages.email-verify',$data);
        }


        public function verifyStore(Request $request){
                 $request->validate([
                        'code' => 'required',
                        'email' => 'required',
                    ]);
                    $checkData = User::where('email',$request->email)->where('code',$request->code)->first();
                    if($checkData){
                        $checkData->status = '1';
                        $checkData->save();
                        return redirect()->route('customer.login')->with('success','you have successfully varified ! please login');
                    }else{
                        return redirect()->back()->with('error' ,'Sorry ! email or verification code does not match!');
                    }

        }

       public function checkOut()
        {
             $data['logo'] = Logo::first();
            $data['contact'] = Contact::first();
            return view('frontend.single_pages.customer_chekout',$data);
        }


        public function checkoutStore(Request $request)
        {
            $request->validate([
                        'name' => 'required',
                        'address' => 'required',
                        'mobile_no' => ['required','regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/'],
                    ]);

                   $checkout = new Shipping();
                   $checkout->user_id = Auth::user()->id;
                   $checkout->name = $request->name;
                   $checkout->email = $request->email;
                   $checkout->mobile_no = $request->mobile_no;
                   $checkout->address = $request->address;
                   $checkout->save();
                   Session::put('shipping_id',$checkout->id);
                   return redirect()->route('customer.payment')->with('success','Data save successfully');
        }







}
