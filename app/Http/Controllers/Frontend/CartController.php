<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Logo;
use App\Model\Size;
use App\Model\Color;
use App\Model\Contact;
use App\Model\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;


class CartController extends Controller
{
    public function addCart(Request $request){
            $request->validate([
                'size_id' => 'required',
                'color_id' => 'required',

            ]);
           $product = Product::where('id',$request->id)->first();
           $product_size = Size::where('id',$request->size_id)->first();
           $product_color = Color::where('id',$request->color_id)->first();

            Cart::add([
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'attributes' => [
                    'size_id' => $request->size_id,
                    'size_name' => $product_size->name,
                    'color_id' => $request->color_id,
                    'color_name' => $product_color->name,
                    'image' => $product->image,
                    ],

              ]);

           return redirect()->route('show.cart')->with('success','Product Added Successfully');
    }

    public function showCart(){
             $data['logo'] = Logo::first();
              $data['contact'] = Contact::first();
        return view('frontend.single_pages.shopping-cart',$data);
    }

    public function updateCart(Request $request){
            Cart::update($request->rowId,[
                        'quantity' => [
                            'relative' => false,
                            'value' => $request->quantity,
                            ],
                        ]);
            return redirect()->route('show.cart')->with('success','Product Updated Successfully');
    }

    public function deleteCart($rowId){
         Cart::remove($rowId);
         return redirect()->route('show.cart')->with('success','Product Deleted Successfully');
    }



}
