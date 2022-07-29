<?php

namespace App\Http\Controllers;

use App\Models\slider;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;
use App\Models\User;

class SliderController extends Controller
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
        return view('slider.index', [
            'sliders' => Slider::all(),
            'deleted_sliders' => Slider::onlyTrashed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slider.create', [

        ]);
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
            'slider_name' => 'required',
        ],[
            'slider_name.required' => 'You are field empty',
            'slider_name.unique' => 'It has happened again'
        ]);

        // photo uploated code start

        // if(auth()->user()->slider_photo != 'slider_photo.jpg'){
        //     unlink(base_path('public/upload/slider_photo/') . auth()->user()->slider_photo);
        // }
        $new_name = auth()->id()."-".Str::random(6).".". $request->file('slider_photo')->getClientOriginalExtension();
        $save_link = base_path('public/upload/slider_photo/') . $new_name;
        Image::make($request->file('slider_photo'))->resize(514,583)->save($save_link);

        // User::find(auth()->id())->update([
        //     'slider_photo' => $new_name
        // ]);
        Slider::insert([
            'slider_name' => $request->slider_name,
            'created_by' => auth()->id(),
            'created_at' => Carbon::now(),
            'slider_photo' => $new_name
        ]);

    // photo uploated code end

    return back()->with('success', 'Slider added Successfullu');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::find($id);

        return view('slider.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,slider $slider)
    {
        $request->validate([
            'slider_name' => 'required|unique:sliders,slider_name,'. $slider->id
        ],[
            'slider_name.required' => 'You are field empty',
            'slider_photo.required' => 'You are Photo empty',
            'slider_name.unique' => 'arekbar hoyche'
        ]);

        $slider->update([
            'slider_name' => $request->slider_name,
            'slider_photo' => $request->slider_photo
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(slider $slider)
    {
        $slider->delete();
        return back();
    }

    public function restore($id)
    {
    //     Category::onlyTrashed()->where('id', $id)->update([
    //         'deleted_by' => NULL
    //    ]);
        Slider::onlyTrashed()->where('id', $id)->restore();
          return back();
    }

    public function forcedelete($id)
    {
        Slider::onlyTrashed()->where('id', $id)->forceDelete();
        return back();
    }
}
