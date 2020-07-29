<?php

namespace App\Http\Controllers\Backend;

use App\Model\Logo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoController extends Controller
{
    public function view(){
        $data['countLogo'] = Logo::count();
        $data['allData'] = Logo::all();
        return view('backend.logo.view-logo',$data);
    }

    public function add(){
       return view('backend.logo.add-logo');
    }

    public function store(Request $request){

        $data = new Logo();
        $data->created_by  = Auth::user()->id;
         if ($request->file('image')) {
                $file = $request->file('image');
                $fileName =date('YmdHi').$file->getClientOriginalName();
                $file->move('upload/logo_images/', $fileName);
                $data['image'] = $fileName;
            }
        $data->save();

        return redirect()->route('logos.view')->with('success','Data Inserted Successfully');

    }


     public function edit($id){
            $editData = Logo::findOrfail($id);
           return view('backend.logo.edit-logo',compact('editData'));

    }


    public function update(Request $request, $id ){
        $data = Logo::findOrfail($id);

        $data->updated_by  = Auth::user()->id;

        if ($request->file('image')) {
                $file = $request->file('image');
                 @unlink('upload/logo_images/'.$data->image);
                $fileName =date('YmdHi').$file->getClientOriginalExtension();
                $file->move('upload/logo_images/', $fileName);
                $data['image'] = $fileName;
            }

        $data->save();

        return redirect()->route('logos.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $logo = Logo::findOrfail($id);
        if(file_exists('upload/logo_images/' . $logo->image) AND ! empty($logo->image)){
            @unlink('upload/logo_images/' . $logo->image);
        }
        $logo->delete();
       return redirect()->route('logos.view')->with('success','Data Deleted Successfully');
    }





}
