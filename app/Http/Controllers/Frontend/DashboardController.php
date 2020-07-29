<?php

namespace App\Http\Controllers\Frontend;

use App\User;
use App\Model\Logo;
use App\Model\Order;
use App\Model\Contact;
use App\Model\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class DashboardController extends Controller
{
    public function dashboard(){

        $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
         $data['user'] = Auth::user();
        return view('frontend.single_pages.customer-dashboard',$data);

    }

   public function editProfile()
    {
        $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
         $data['editData'] = User::find(Auth::user()->id);
        return view('frontend.single_pages.customer-edit-profile',$data);
    }


    public function updateProfile(Request $request)
    {
          $user = User::find(Auth::user()->id);
         $request->validate([
                        'name' => 'required',
                        'email' => 'required|unique:users,email,'.$user->id,
                        'mobile' => ['required','unique:users,mobile,'.$user->id, 'regex:/(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/']
         ]);

         $user->name = $request->name;
         $user->email = $request->email;
         $user->mobile = $request->mobile;
         $user->address = $request->address;
         $user->gender = $request->gender;

         if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/user_images/'.$user->image));
                $fileName =date('YmdHi').$file->getClientOriginalExtension();
                $file->move(public_path('upload/user_images/'), $fileName);
                $user['image'] = $fileName;
            }
        $user->save();
         return redirect()->route('dashboard')->with('success','Profiles updated Successfully');
    }



    public function passwordChange()
    {
         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
        return view('frontend.single_pages.customer-password-change',$data);
    }

    public function passwordupdate(Request $request)
    {
           if(Auth::attempt(['id' =>Auth::user()->id, 'password' => $request->current_password])){
            $user = User::findOrfail(Auth::user()->id);
             $user->password = bcrypt($request->new_password);
             $user->save();
             return redirect()->route('dashboard')->with('success','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Sorry! your corrent password dost not match ');
        }

    }


    public function payment()
        {
            $data['logo'] = Logo::first();
            $data['contact'] = Contact::first();
            //   @dd(Session()->put('shipping_id'));
            return view('frontend.single_pages.customer_payment',$data);
        }

        public function paymentStore(Request $request)
        {
            if($request->product_id == null){
                 return redirect()->back()->with('message','Please add any product');
            }else{

                $request->validate([
              'payment_method' => 'required',
            ]);
            if($request->payment_method == 'Bkash' && $request->transaction_no == null ){
                return redirect()->back()->with('message','Please enter your Transaction no');
                }
                DB::transaction(function ()  use($request){
                    $payment = new Payment();
                    $payment->payment_method = $request->payment_method;
                    $payment->transaction_no = $request->transaction_no;
                    $payment->save();

                    $order = new Order();
                    $order->user_id = Auth::user()->id;
                    $order->shipping_id = Session::get('shipping_id');
                    $order->payment_id = $payment->id;
                    $order_data = Order::orderBy('id','desc')->first();

                    if($order_data == null){
                         $firstReg = '0';
                         $order_no = $firstReg+1;
                    }else{
                        $order_data = Order::orderBy('id','desc')->first()->order_no ;
                        $order_no = $order_data+1;
                    }
                    $order->order_no = $order_no;
                    $order->order_total = $request->order_total;
                    $order->status = '0';
                    $order->save();
                    $contents = Cart::getContent();

                    foreach($contents as $content){
                        $order_details = new OrderDetail();
                        $order_details->order_id = $order->id;
                        $order_details->product_id = $content->id;
                        $order_details->color_id = $content->attributes->color_id;
                        $order_details->size_id = $content->attributes->size_id;
                        $order_details->quantity = $content->quantity;
                        $order_details->save();
                    }
                });


            }

            Cart::remove($request->id);
            return redirect()->route('customer.order.list')->with('success','Data Saved Successfully');

        }

        public function orderList()
        {
            $data['logo'] = Logo::first();
            $data['contact'] = Contact::first();
            $data['orders'] = Order::where('user_id',Auth::user()->id)->get();
            return view('frontend.single_pages.customer-order',$data);
        }

        public function orderDetails($id)
        {
            $orderData = Order::find($id);
            $data['order'] = Order::where('id',$orderData->id)->where('user_id',Auth::user()->id)->first();
            if($data['order']==false){
                return redirect()->back()->with('error','Do not try to be over Smart !');
            }else{
            $data['logo'] = Logo::first();
            $data['contact'] = Contact::first();
            $data['order'] = Order::with(['order_details'])->where('id',$orderData->id)->where('user_id',Auth::user()->id)->first();
            return view('frontend.single_pages.customer-order-details',$data);
            }

        }


        public function orderPrint($id)
        {
            $orderData = Order::find($id);
            $data['order'] = Order::where('id',$orderData->id)->where('user_id',Auth::user()->id)->first();
            if($data['order']==false){
                return redirect()->back()->with('error','Do not try to be over Smart !');
            }else{
            $data['logo'] = Logo::first();
            $data['contact'] = Contact::first();
            $data['order'] = Order::with(['order_details'])->where('id',$orderData->id)->where('user_id',Auth::user()->id)->first();
            return view('frontend.single_pages.customer-order-print',$data);
            }

        }



}
