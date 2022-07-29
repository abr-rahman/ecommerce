<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Psy\Formatter\Formatter;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', [
            'categories' => Category::all(),
            'deleted_categories' => Category::onlyTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'category_name' => 'required|unique:categories',
            'category_photo' => 'required|image'
        ],[
            'category_name.required' => 'You are field empty',
            'category_name.unique' => 'arekbar hoyche'
        ]);

        // photo uploated code start

            $new_name = auth()->id()."-".Str::random(6).".". $request->file('category_photo')->getClientOriginalExtension();
            $save_link = base_path('public/upload/category_photo/') . $new_name;
            Image::make($request->file('category_photo'))->resize(600,328)->save($save_link);

        Category::insert([
            'category_name' => $request->category_name,
            'created_by' => auth()->id(),
            'created_at' => Carbon::now(),
            'category_photo' => $new_name
        ]);
        // photo uploated code end
        return back()->with('success', 'Category added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       // return $id;
        $category = Category::find($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit( $id )
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name,'. $category->id
        ],[
            'category_name.required' => 'You are field empty',
            'category_name.unique' => 'arekbar hoyche'
        ]);

        // $category->update([
        //     'category_name' => $request->category_name
        // ]);
        // return back();

        // $category->category_name = $request->category_name;
        // $category->save();

        $category = Category::find($id);
        $category->category_name = $request->input('category_name');
        $category->updated_by = auth()->id();
        $category->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        // $category->delete();

        // $id->deleted_by = auth()->id();
        // $id->save();
        return back();
    }

    public function restore($id)
    {
    //     Category::onlyTrashed()->where('id', $id)->update([
    //         'deleted_by' => NULL
    //    ]);
        Category::onlyTrashed()->where('id', $id)->restore();
          return back();
    }

    public function forcedelete($id)
    {
        Category::onlyTrashed()->where('id', $id)->forceDelete();
        Subcategory::where('category_id', $id)->forcedelete();
        return back();
    }



}
