<?php

namespace App\Http\Controllers\Backend;

use App\Model\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{


public function view(){
        $data['countContact'] = About::count();
        $data['allData'] = About::all();
        return view('backend.about.view-about',$data);
    }

    public function add(){
       return view('backend.about.add-about');
    }

    public function store(Request $request){

        $data = new About();
        $data->description  = $request->description;
        $data->created_by  = Auth::user()->id;
        $data->save();

        return redirect()->route('abouts.view')->with('success','Data Inserted Successfully');

    }


     public function edit($id){
            $editData = About::findOrfail($id);
           return view('backend.about.edit-about',compact('editData'));

    }


    public function update(Request $request, $id ){
        $data = About::findOrfail($id);
        $data->description  = $request->description;
        $data->updated_by  = Auth::user()->id;

        $data->save();

        return redirect()->route('abouts.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $service = About::findOrfail($id);
        $service->delete();
       return redirect()->route('abouts.view')->with('success','Data Deleted Successfully');
    }




}
