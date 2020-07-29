<?php

namespace App\Http\Controllers\Backend;

use App\Model\Brand;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{


public function view(){

        $data['editData'] = Brand::all();
        return view('backend.brand.view-brand',$data);
    }

    public function add(){
       return view('backend.brand.add-brand');
    }

    public function store(Request $request){
             $request->validate([
            'name' => 'required|unique:brands,name',
        ]);

        $data = new Brand();
        $data->name  = $request->name;
        $data->created_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('brands.view')->with('success','Data Inserted Successfully');
    }

     public function edit($id){
            $editData = Brand::findOrfail($id);
           return view('backend.brand.add-brand',compact('editData'));

    }


    public function update(BrandRequest $request, $id ){
        $data = Brand::findOrfail($id);
        $data->name  = $request->name;
        $data->updated_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('brands.view')->with('success','Data updated Successfully');

    }

    public function delete($id){

        $brands = Brand::findOrfail($id);
        $brands->delete();
       return redirect()->route('brands.view')->with('success','Data Deleted Successfully');
    }


}
