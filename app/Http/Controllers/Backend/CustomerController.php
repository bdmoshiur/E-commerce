<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function view(){

        $allData = User::where('usertype', 'customer')->where('status','1')->get();
        return view('backend.customer.view-customer',compact('allData'));
    }


    public function draftView(){

        $allData = User::where('usertype', 'customer')->where('status','0')->get();
        return view('backend.customer.draft-customer',compact('allData'));
    }


    public function delete(Request $request){
        $customer = User::findOrfail($request->id);
        if(file_exists('upload/user_images/' . $customer->image) AND ! empty($customer->image)){
            @unlink('upload/user_images/' . $customer->image);
        }
        $customer->delete();
        return redirect()->route('customers.draft.view')->with('success', 'Data deleted successfully'); 
    }




}
