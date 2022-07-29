<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Team;
use App\Models\User;
use App\Models\Color;
use App\Models\Order_summery;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkrole');
    }

    public function index()
    {

        $order_summeries = Order_summery::all();
        $total_categories = Category::count();
        $total_user = User::count();
        return view('home', compact('total_categories','total_user', 'order_summeries'));
    }
    public function addmember()
    {
        return view('team.addteammember');
    }
    public function addmemberinsert(Request $request){
       Team::insert([
           'name' => $request->team_member_name
       ]);

       return back()->with('success_message', 'Team Member Addedd Successfully');
    }
    public function addmemberdelete($team_id){
         Team::find($team_id)->delete();
         return back()->with('delete_message', 'Team Member Deleted Successfully');
     }

    public function addmemberedite($team_id){
       // return
        return view('team.editeteammember', [
            'team_info' => Team::find(Crypt::decrypt($team_id))
        ]);
    }
    public function addmemberupdate(Request $request, $team_id){
     //  return $team_id."#".$request->team_member_name;
       Team::find($team_id)->update([
           'name' => $request->team_member_name
       ]);
       return back();
    }

    public function profile(){
        return view('profile.index');
    }

    public function changename(Request $request){

        $request->validate([
            'name' => 'required',
            'phone_number' => 'nullable|digits:11'
        ]);
        User::find(auth()->id())->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address
        ]);

        // photo uploated code start
            if($request->hasFile('profile_photo')){
                if(auth()->user()->profile_photo != 'profile_photo.jpg'){
                    unlink(base_path('public/upload/profile_photo/') . auth()->user()->profile_photo);
                }
                // step-1: new profile photo name create
                $new_name = auth()->id()."-".Str::random(6).".". $request->file('profile_photo')->getClientOriginalExtension();
                // step-2: new profile photo upload
                $save_link = base_path('public/upload/profile_photo/') . $new_name;
                Image::make($request->file('profile_photo'))->resize(300,300)->text('goldfish', 10, 10)->save($save_link, 10);
                // step-3: new profile photo update at database
                User::find(auth()->id())->update([
                    'profile_photo' => $new_name
                ]);
            }

        // photo uploated code end

        // cover_photo uploated code start

        // if($request->hasFile('cover_photo')) {
        //     if(auth()->user()->cover_photo != 'cover_photo.jpg'){
        //         unlink(base_path('public/upload/cover_photo/') . auth()->user()->cover_photo);
        //     }
            // step-1: new cover photo name create
            $new_name = auth()->id()."-".Str::random(6).".". $request->file('cover_photo')->getClientOriginalExtension();
            // step-2: new cover photo upload
            $save_link = base_path('public/upload/cover_photo/') . $new_name;
            Image::make($request->file('cover_photo'))->resize(1600,451)->save($save_link, 10);


            // step-3: new cover photo update at database
            $cover =  User::find(auth()->id());
            $cover->cover_photo = $new_name;
            $cover->save();

            // User::find(auth()->id())->update([
            //     'cover_photo' => $new_name,
            // ]);
        //}
        // cover_photo uploated code end


        return back()->with('status', 'Changed successfully');
    }

     public function changepassword(Request $request){

        // return $request->current_password;

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|alpha_num|min:6',
            'password_confirmation' => 'required'
        ]);

        if($request->current_password == $request->password){
            return back()->withErrors(['current_password_err' => 'Your new password can not same as current password!']);
        }
       if(Hash::check($request->current_password, auth()->user()->password)){
           User::find(auth()->id())->update([
               'password' => bcrypt($request->password)
           ]);
           return back()->with('change_password', 'Changed successfully!');
       }
       else{
            return back()->withErrors(['current_password_err' => 'Your current password is wrong!']);
       }
   }


   public function variation(){

    return view('variation.index', [
        'colors' => Color::all(),
        'sizes' => Size::all()
    ]);
   }

   public function addcolor(Request $request){

    $request->validate([
        'color_name' => 'required',
        'color_code' => 'required'
    ],[
        'color_name.required' => 'You are field empty',
        'color_name' => 'arekbar hoyche',
    ]);
      Color::insert($request->except('_token')+['created_at' => Carbon::now()]);

      return back();
   }

    public function addsize(Request $request){

    Size::insert($request->except('_token')+['created_at' => Carbon::now()]);
    return back();
    }






}
