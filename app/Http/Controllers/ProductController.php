<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Size;
use App\Models\Subcategory;
use App\Models\Pro_multiple_photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;;
use Illuminate\Support\Facades\Storage;;
use Illuminate\Support\Str;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
        //  $this->middleware('checkrole')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           // '*' => 'required',
            'product_name' => 'required',
            'regular_price' => 'required',
            'category_id' => 'required',
            'long_description' => 'required',
            'subcategory_id' => 'required'
        ]);

        if($request->dicsounted_price == NULL){
            $dicsounted_price = $request->regular_price;
        }else{
            $dicsounted_price = $request->dicsounted_price;
        }
        if($request->dicsounted_price > $request->regular_price){
           return back()->withErrors([
            'message'=> 'Discounted Price too long!'
           ]);
        }

        $slug = Str::slug($request->product_name)."-".Str::random(5);
        $sku = Str::random(8);
        $product_id = Product::insertGetId($request->except('_token', 'dicsounted_price')+[
            'dicsounted_price' => $dicsounted_price,
            'slug' => $slug,
            'sku' => $sku,
            'created_at' => Carbon::now()
        ]);

        if($request->hasFile('pro_thumbnail_photo')){
            // photo uploaded start
            $new_name = auth()->id()."-".Str::random(6).".". $request->file('pro_thumbnail_photo')->getClientOriginalExtension();
            $save_link = base_path('public/upload/pro_thumbnail_photo/') . $new_name;
            Image::make($request->file('pro_thumbnail_photo'))->resize(270,310)->save($save_link);
            // photo uploaded end
            Product::find($product_id)->update([
                'pro_thumbnail_photo' => $new_name
            ]);
        };

        return back()->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back();
    }

    public function getsubcategory(Request $request)
    {

        $subcategories = Subcategory::where('category_id', $request->category_id)->get();
        if($subcategories->count() == 0){
            $str_to_send = "<option value=''>>--No SubCategory at database--<</option>";
        }else{
            $str_to_send = "<option value=''>>--Choose One--<</option>";
        }
        foreach($subcategories as $subcategory){
           // echo $subcategory->subcategory_name. $subcategory->id;

            $str_to_send .= "<option value='$subcategory->id'>$subcategory->subcategory_name</option>";
        }
        echo $str_to_send;
    }

    public function addfeature($product_id){
        $product = Product::find($product_id);
        $pro_multiple_photos = Pro_multiple_photo::where('product_id', $product_id)->get();
        return view('product.addfeature', compact('product_id','product', 'pro_multiple_photos'));
    }

    public function addfeaturepost(Request $request, $product_id){

        $request->validate([
            'pro_multiple_photo' => 'required',
        ]);

        $status = true;
        foreach($request->file('pro_multiple_photo') as $key => $pro_multiple_photo){
            if(!in_array($pro_multiple_photo->getClientOriginalExtension(), ['jpg', 'png', 'webp'])){
                $status = false;
            }
        }
        if($status){
            foreach($request->file('pro_multiple_photo') as $key => $pro_multiple_photo){

                // photo uploated code start
                $new_name = $product_id ."-".Str::random(5).".". $pro_multiple_photo->getClientOriginalExtension();
                $save_link = base_path('public/upload/pro_multiple_photo/') . $new_name;
                Image::make($pro_multiple_photo)->resize(300,340)->save($save_link);

                // photo uploated code end
                Pro_multiple_photo::insert([
                    'product_id' => $product_id,
                    'pro_multiple_photo_name' => $new_name,
                    'created_at' => Carbon::now()
                ]);

            }
            return back();
        }
        else{
            return back()->with('file_err', 'There is one or any unsupported file');
        }

    }

    public function addfeaturedelete ($id)
    {

        // unlink(base_path('public/upload/pro_multiple_photo/') . auth()->user()->pro_multiple_photo);
        // return 'fgsf';

        Storage::disk('public')->delete('upload/pro_multiple_photo/');
        return back();
    }

    public function addinventory ($product_id){
        $product = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id',$product_id)->get();
        return view('product.addinventory', compact('product_id','product','colors', 'sizes', 'inventories'));
    }

    public function addinventorypost (Request $request, $product_id){

        $request -> validate([
            '*' => 'required',
            'color_id' => 'required'
        ]);

        $is_exists = Inventory::where([
          'product_id' => $product_id,
          'color_id' => $request->color_id,
          'size_id' => $request->size_id,
        ])->exists();

        if($is_exists){
            Inventory::where([
                'product_id' => $product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
              ])->increment('quantity_id', $request->quantity_id);
        }
        else{
             Inventory::insert([
                'product_id' => $product_id,
                'color_id' => $request->color_id,
                'size_id' => $request->size_id,
                'quantity_id' => $request->quantity_id,
                'created_at' => Carbon::now()
            ]);
        }
        return back()->with('success', 'Inventory added Successfully');

    }

    // public function productinventorydelete($id){
    //     Inventory::where($id)->delete();
    //     return back()->with('delete_message', 'Team Member Deleted Successfully');
    // }

    public function productrestore($id)
    {
        Product::onlyTrashed()->where('id', $id)->restore();
          return back();
    }

    public function productforcedelete($id)
    {
        Product::onlyTrashed()->where('id', $id)->forceDelete();
        return back();
    }

}
