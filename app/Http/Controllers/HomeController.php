<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class HomeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('home');
    }

    public function showChangePasswordForm() {
        return view('auth.changePassword');
    }

    public function changePassword(Request $request){ 
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully!");
    }

    public function showUpdateAccountDetailsForm() {
        return view('updateAccountDetails');
    }

    public function updateAccountDetails(Request $request) {
        $user = Auth::user();
        $user->street = $request->get('street');
        $user->street_num = $request->get('street_num');
        $user->post_code = $request->get('post_code');
        $user->city = $request->get('city');
        $user->country = $request->get('country');
        $user->phone_number = $request->get('phone_number');
        $user->iban = $request->get('iban');
        $user->bicswift = $request->get('bicswift');
        $user->bank_name = $request->get('bank_name');
        $user->save();

        return redirect()->route('main');
    }
}