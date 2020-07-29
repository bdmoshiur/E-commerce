<?php

namespace App\Http\Controllers\Backend;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{

public function view(){
        $data['editData'] = Category::all();
        return view('backend.category.view-category',$data);
    }

    public function add(){
       return view('backend.category.add-category');
    }

    public function store(Request $request){
         $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        $data = new Category();
        $data->name  = $request->name;
        $data->created_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('categories.view')->with('success','Data Inserted Successfully');

    }

     public function edit($id){
            $editData = Category::findOrfail($id);
           return view('backend.category.add-category',compact('editData'));
    }


    public function update(CategoryRequest $request, $id ){

        $data = Category::findOrfail($id);
        $data->name  = $request->name;
        $data->updated_by  = Auth::user()->id;
        $data->save();
        return redirect()->route('categories.view')->with('success','Data updated Successfully');

    }

    public function delete($id){
        $categories = Category::findOrfail($id);
        $categories->delete();
       return redirect()->route('categories.view')->with('success','Data Deleted Successfully');
    }







}
