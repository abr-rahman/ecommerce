<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Image;
use App\Models\User;
use App\Models\feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
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
        return view('feature.index', [
            'features' => Feature::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'feature_name.required' => 'You are field empty',
            'feature_name.unique' => 'It has happened again'
        ]);

        // photo uploated code start

        $new_name = auth()->id()."-".Str::random(6).".". $request->file('feature_photo')->getClientOriginalExtension();
        $save_link = base_path('public/upload/feature_photo/') . $new_name;
        Image::make($request->file('feature_photo'))->resize(42,34)->save($save_link);

        Feature::insert([
            'feature_name' => $request->feature_name,
            'about_feature' => $request->about_feature,
            'created_at' => Carbon::now(),
            'feature_photo' => $new_name
        ]);

    // photo uploated code end

    return back()->with('success', 'Slider added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show(feature $feature)
    {
        return view('feature.show', compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit(feature $feature)
    {
        return view('feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, feature $feature)
    {
        $request->validate([
            'feature_name' => 'required|unique:features,feature_name,'. $feature->id
        ],[
            'feature_name.required' => 'You are field empty',
            'feature_photo.required' => 'You are Photo empty',
            'feature_name.unique' => 'arekbar hoyche'
        ]);

        $feature->update([
            'feature_name' => $request->feature_name,
            'about_feature' => $request->about_feature,
            'feature_photo' => $request->feature_photo
        ]);
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy(feature $feature)
    {
        $feature->delete();
        return back();
    }
}
