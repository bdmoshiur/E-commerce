<?php

namespace App\Http\Controllers\Backend;

use App\Model\Size;
use Illuminate\Http\Request;
use App\Http\Requests\SizeRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SizeController extends Controller
{

     public function view(){

        $data['editData'] = Size::all();
        return view('backend.size.view-size',$data);
    }

    public function add(){
       return view('backend.size.add-size');
    }

    public function store(Request $request){
             $request->validate([
            'name' => 'required|unique:sizes,name',
        ]);

        $data = new Size();
        $data->name  = $request->name;
        $data->created_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('sizes.view')->with('success','Data Inserted Successfully');
    }

     public function edit($id){
            $editData = Size::findOrfail($id);
           return view('backend.size.add-size',compact('editData'));

    }


    public function update(SizeRequest $request, $id ){
        $data = Size::findOrfail($id);
        $data->name  = $request->name;
        $data->updated_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('sizes.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $sizes = Size::findOrfail($id);
        $sizes->delete();
       return redirect()->route('sizes.view')->with('success','Data Deleted Successfully');
    }





}
