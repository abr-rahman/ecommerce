<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order_summery;
use Faker\Provider\UserAgent;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    public function customerlogin()
    {
        Session::put('login_previous_link', url()->previous());
        return view('customer.login');
    }

    public function customerregister(Request $request)
    {
        //User::insert($request->except('_token'));
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'role' => 'customer',
            'created_at' => Carbon::now()
        ]);


        //SMS C0DE START

        // 1000 = Invalid user or Password
        // 1002 = Empty Number
        // 1003 = Invalid message or empty message
        // 1004 = Invalid number
        // 1005 = All Number is Invalid
        // 1006 = insufficient Balance
        // 1009 = Inactive Account
        // 1010 = Max number limit exceeded
        // 1101 = Success


        $url = "http://66.45.237.70/api.php";
        $number="$request->phone_number";
        $text="Hello $request->name, Your Account created successfully in Goldfish eCommerce";
        $data= array(
        // 'username'=>"01834833973",
        // 'password'=>"TE47RSDM",
        'number'=>"$number",
        'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
         $sendstatus = $p[0];
        //SMS C0DE END

        return back()->with('customer_reg_succ', 'Customer Account Register Success');
    }

    public function customerdashboard(){

        // je page thake login korle se page niyee jabe
        $link_to_go = Session::get('login_previous_link');
        Session::put('login_previous_link', '');
        if($link_to_go){
            return redirect($link_to_go);
        }
        // je page thake login end
        $order_summeries = Order_summery::where('user_id', auth()->id())->get();
        return view('customer.dashboard', compact('order_summeries'));
    }

}
