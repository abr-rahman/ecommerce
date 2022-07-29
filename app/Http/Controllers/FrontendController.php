<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\feature;
use App\Models\Inventory;
use App\Models\slider;
use App\Models\Product;
use App\Models\Pro_multiple_photo;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use make;

class FrontendController extends Controller
{
    public function index(){
        // api start
            $response = Http::get('https://fakestoreapi.com/products');
            $api_products = json_decode($response->body(), true);

        // api end


       // return Hash::make('12345678');

        $categories = Category::all();
        $sliders = slider::all();
        $features = feature::all();
        $products = Product::latest()->get();       // single datar jonno first use korte hoy
        $carts = Cart::all();

        return view('welcome', compact('categories','sliders', 'features', 'products', 'api_products', 'carts'));
    }

    public function about(){
        return view('about');
    }

    public function contact(){
        $location = 'Bhola';
        return view('contact', compact('location'));
    }

    public function productdetails ($slug){

      $product = Product::where('slug', $slug)->first();
      $pro_multiple_photos = Pro_multiple_photo::where('product_id', $product->id)->get();
      // jodi related product limite korte chan......... latest()->take(3)
      $related_products = Product::where('subcategory_id', $product->subcategory_id)->where('id', '!=', $product->id)->get();
      $inventories = Inventory::where('product_id', $product->id)->select('color_id')->groupBy('color_id')->get();
      $total_inventory = Inventory::where('product_id', $product->id)->sum('quantity_id');
      $reviews = Review::where('product_id', $product->id)->get();
       return view('productdetails', compact('product', 'related_products', 'pro_multiple_photos', 'inventories', 'total_inventory', 'reviews'));
    }

    public function getsizes(Request $request){
        $strsize = "<option> >--Choose One--< </option>";
        $sizes = Inventory::where([
        'product_id' => $request->product_id,
        'color_id' => $request->color_id,
       ])->get();
       foreach($sizes as $size){
           $strsize .= "<option value='$size->size_id'>".$size->relationtosize->size_name."</option>";
       }
       echo $strsize;
    }

    public function getinventory(Request $request){
        $inventory = Inventory::where([
            'product_id' => $request->product_id,
            'color_id' => $request->color_id,
            'size_id' => $request->size_id
        ])->first()->quantity_id;
        echo $inventory;
    }




    public function team(){
       $members_name = Team::all();
        //$members_name = ['Arif', 'Khan', 'Riaz', 'Vondo'];
        return view('team', compact('members_name'));
    }

    // public function shop_class(){
    //     return view('shop');
    // }
}
