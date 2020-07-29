<?php

namespace App\Http\Controllers\Backend;

use App\Model\Color;
use Illuminate\Http\Request;
use App\Http\Requests\ColorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{



public function view(){

        $data['editData'] = Color::all();
        return view('backend.color.view-color',$data);
    }

    public function add(){
       return view('backend.color.add-color');
    }

    public function store(Request $request){
             $request->validate([
            'name' => 'required|unique:colors,name',
        ]);

        $data = new Color();
        $data->name  = $request->name;
        $data->created_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('colors.view')->with('success','Data Inserted Successfully');
    }

     public function edit($id){
            $editData = Color::findOrfail($id);
           return view('backend.color.add-color',compact('editData'));

    }


    public function update(ColorRequest $request, $id ){
        $data = Color::findOrfail($id);
        $data->name  = $request->name;
        $data->updated_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('colors.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $colors = Color::findOrfail($id);
        $colors->delete();
       return redirect()->route('colors.view')->with('success','Data Deleted Successfully');
    }




}
