<?php

namespace App\Http\Controllers\Backend;

use App\Model\Size;
use App\Model\Brand;
use App\Model\Color;
use App\Model\Product;
use App\Model\Category;
use App\Model\ProductSize;
use App\Model\ProductColor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Model\ProductSubImage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
      public function view(){
        $data['allData'] = Product::all();
        return view('backend.product.view-product',$data);
    }

    public function add(){
        $data['categories'] =  Category::all();
        $data['brands'] =  Brand::all();
        $data['colors'] =  Color::all();
        $data['sizes'] =  Size::all();
       return view('backend.product.add-product',$data);
    }

    public function store(Request $request){
        DB::transaction(function () use($request){

             $request->validate([
            'name' => 'required|unique:products,name',
            'color_id' => 'required',
            'size_id' => 'required'
        ]);

        $product = new Product();
        $product->name  = $request->name;
        $product->slug  = Str::slug($request->name);
        $product->price  = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;
        $img = $request->file('image');
         if ($img) {
                $imgName =date('YmdHi').$img->getClientOriginalName();
                $img->move(public_path('upload/product_images/'), $imgName);
                $product['image'] = $imgName;
            }
            if($product->save()){
                $files = $request->sub_image;
                if(!empty($files)){
                    foreach($files as $file){
                        $imgName =date('YmdHi').$file->getClientOriginalName();
                        $file->move(public_path('upload/product_images/product_sub_images'), $imgName);
                        $subimage['sub_image'] = $imgName;

                        $subimage = new ProductSubImage();
                        $subimage->product_id = $product->id;
                        $subimage->sub_image = $imgName;
                        $subimage->save();
                    }
                }
                $colors = $request->color_id;
                if(!empty($colors)){
                    foreach($colors as $color){
                        $mycolor = new ProductColor();
                        $mycolor->product_id = $product->id;;
                        $mycolor->color_id = $color;
                        $mycolor->save();
                    }
                }
                $sizes = $request->size_id;
                if(!empty($sizes)){
                    foreach($sizes as $size){
                        $mysize = new ProductSize();
                        $mysize->product_id = $product->id;
                        $mysize->size_id = $size;
                        $mysize->save();
                    }
                }
            }else{
                return redirect()->back()->with('error','Sorry! Data not Save');
            }

           });

        return redirect()->route('products.view')->with('success','Data Inserted Successfully');
    }

     public function edit($id){
            $data['editData'] = Product::findOrfail($id);
            $data['categories'] =  Category::all();
            $data['brands'] =  Brand::all();
            $data['colors'] =  Color::all();
            $data['sizes']  =  Size::all();
            $data['color_array']  = ProductColor::select('color_id')->where('product_id', $data['editData']->id)->orderBy('id','asc')->get()->toArray();
            $data['size_array']   = ProductSize::select('size_id')->where('product_id', $data['editData']->id)->orderBy('id','asc')->get()->toArray();
            return view('backend.product.add-product',$data);

    }


    public function update(ProductRequest $request, $id){
        DB::transaction(function () use($request,$id){

                    $request->validate([
                    'color_id' => 'required',
                    'size_id' => 'required'
                ]);

            $product = Product::findOrfail($id);
            $product->name  = $request->name;
             $product->slug  = Str::slug($request->name);
            $product->price  = $request->price;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->short_desc = $request->short_desc;
            $product->long_desc = $request->long_desc;

         $img = $request->file('image');
         if ($img) {
                $imgName =date('YmdHi').$img->getClientOriginalName();
                $img->move(public_path('upload/product_images/'), $imgName);
                if(file_exists('upload/product_images/'.$product->image) AND ! empty($product->image)){
                    @unlink('upload/product_images/'.$product->image);
                }
                $product['image'] = $imgName;
            }
            if($product->save()){
                $files = $request->sub_image;
                if(!empty($files)){
                    $subImage = ProductSubImage::where('product_id',$id)->get()->toArray();
                    foreach($subImage as $value){
                        if(!empty($value)){
                            @unlink('upload/product_images/product_sub_images/'.$value['sub_image']);
                        }
                    }
                 ProductSubImage::where('product_id',$id)->delete();
                }
                if(!empty($files)){
                    foreach($files as $file){
                        $imgName =date('YmdHi').$file->getClientOriginalName();
                        $file->move(public_path('upload/product_images/product_sub_images'), $imgName);
                        $subimage['sub_image'] = $imgName;

                        $subimage = new ProductSubImage();
                        $subimage->product_id = $product->id;
                        $subimage->sub_image = $imgName;
                        $subimage->save();
                    }
                }
                $colors = $request->color_id;
                 if(!empty($colors)){
                     ProductColor::where('product_id',$id)->delete();
                 }
                if(!empty($colors)){
                    foreach($colors as $color){
                        $mycolor = new ProductColor();
                        $mycolor->product_id = $product->id;
                        $mycolor->color_id = $color;
                        $mycolor->save();
                    }
                }
                $sizes = $request->size_id;
                 if(!empty($sizes)){
                     ProductSize::where('product_id',$id)->delete();
                 }
                if(!empty($sizes)){
                    foreach($sizes as $size){
                        $mysize = new ProductSize();
                        $mysize->product_id = $product->id;
                        $mysize->size_id = $size;
                        $mysize->save();
                    }
                }
            }else{
                return redirect()->back()->with('error','Sorry! Data not Updated');
            }
        });
        return redirect()->route('products.view')->with('success','Data Updated Successfully');
    }

    public function delete(Request $request, $id){
        $product = Product::findOrfail($request->id);
        if(file_exists('upload/product_images/'.$product->image) AND ! empty($product->image)){
            @unlink('upload/product_images/'.$product->image);
        }
        $subImage = ProductSubImage::where('product_id',$product->id)->get()->toArray();
         if(!empty($subImage)){
                    foreach($subImage as $value){
                        if(!empty($value)){
                            @unlink('upload/product_images/product_sub_images/'.$value['sub_image']);
                        }
                    }
                }
                 ProductSubImage::where('product_id',$product->id)->delete();
                 ProductColor::where('product_id',$product->id)->delete();
                 ProductSize::where('product_id',$product->id)->delete();
                 $product->delete();
       return redirect()->route('products.view')->with('success','Data Deleted Successfully');
    }



    public function details($id){

        $product = Product::findOrfail($id);
        return view('backend.product.product-details',compact('product'));

    }







}
