<?php

namespace App\Http\Controllers\Frontend;

use App\Model\Logo;
use App\Model\About;
use App\Model\Slider;
use App\Model\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Communicate;
use App\Model\Product;
use App\Model\ProductColor;
use App\Model\ProductSize;
use App\Model\ProductSubImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller
{
    public function index(){

        $data['logo'] = Logo::first();
        $data['sliders'] = Slider::all();
        $data['contact'] = Contact::first();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        $data['products'] = Product::orderBy('id','DESC')->paginate(12);
        return view('frontend.layouts.home',$data);
    }

    public function productList(){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        $data['products'] = Product::orderBy('id','DESC')->paginate(12);
        return view('frontend.single_pages.product-list',$data);
    }

    public function categoyWiserProduct($category_id){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        $data['products'] = Product::where('category_id',$category_id)->orderBy('id','DESC')->get();
        return view('frontend.single_pages.category-wise-product',$data);
    }

    public function brandWiserProduct($brand_id){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['categories'] = Product::select('category_id')->groupBy('category_id')->get();
        $data['brands'] = Product::select('brand_id')->groupBy('brand_id')->get();
        $data['products'] = Product::where('brand_id',$brand_id)->orderBy('id','DESC')->get();
        return view('frontend.single_pages.brand-wise-product',$data);
    }

    public function productDetails($slug){
        $data['logo'] = Logo::first();
        $data['contact'] = Contact::first();
        $data['product'] = Product::where('slug',$slug)->first();
        $data['product_sub_images'] = ProductSubImage::where('product_id',$data['product']->id)->get();
        $data['product_colors'] = ProductColor::where('product_id',$data['product']->id)->get();
        $data['product_sizes'] = ProductSize::where('product_id',$data['product']->id)->get();
        return view('frontend.single_pages.product-details',$data);
    }


    public function aboutUs(){
        $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
         $data['abouts'] = About::first();
        return view('frontend.single_pages.about-us',$data);
    }

    public function contactUs(){
        $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
        return view('frontend.single_pages.contact_us',$data);

    }

     public function shoppingCart(){
         $data['logo'] = Logo::first();
         $data['contact'] = Contact::first();
            return view('frontend.single_pages.shopping-cart',$data);
    }



    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:communicates,email',
            'mobile_no' => 'required',
            'address' => 'required',
            'msg' => 'required',
        ]);


        $communicate = new Communicate();
        $communicate->name = $request->name;
        $communicate->email = $request->email;
        $communicate->mobile_no = $request->mobile_no;
        $communicate->address = $request->address;
        $communicate->msg = $request->msg;
        $communicate->save();

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'address' => $request->address,
            'msg' => $request->msg,
        );

        Mail::send('frontend.emails.contact', $data, function ($message) use($data) {
            $message->from('moshiurcse888@gmail.com', 'Moshiur');
            $message->to($data['email'],'Moshiur');
            $message->subject('Thanks for contacts');
        });

        return redirect()->back()->with('success','Data Send Successfully');
    }


    public function findProduct(Request $request)
    {
        $slug = $request->slug;
        $data['product'] = Product::where('slug',$slug)->first();
        if($data['product']){
            $data['logo'] = Logo::first();
            $data['contact'] = Contact::first();
            $data['product_sub_images'] = ProductSubImage::where('product_id',$data['product']->id)->get();
            $data['product_colors'] = ProductColor::where('product_id',$data['product']->id)->get();
            $data['product_sizes'] = ProductSize::where('product_id',$data['product']->id)->get();
            return view('frontend.single_pages.find-product',$data);
        }else{
            return redirect()->back()->with('error','No product does not match!');
        }

    }

    public function getProduct(Request $request)
    {
         $slug = $request->slug;
         $productData = DB::table('products')->where('slug','LIKE','%'.$slug.'%')->get();
        $html = '';
        $html = '<div><ul>';
        if($productData){
            foreach($productData as $v){
                $html .= '<li>'.$v->slug.'</li>';
            }
        }
        $html .= '</ul></div>';
        return response()->join($html);
    }
}
