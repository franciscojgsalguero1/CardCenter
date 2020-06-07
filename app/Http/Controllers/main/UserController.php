<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Transactions;
use App\User;
use Auth;

class UserController extends Controller {

	/*
    * CRUD
    */

    public function index() {
        $user = User::all();
    }

    public function store(Request $request) {
        $user = User::create($request->all());
    }

    public function show($id) {
        $user = User::find($id);
    }

    public function update(Request $request, $id) {
        $user = User::withTrashed()->find($id);
        $user->type = $request->get('type');
        $user->save();

        return redirect()->back();
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
    }

    public function restore($id) {
        $user = User::withTrashed()->find($id)->restore();

        return redirect()->back();
    }

    /*
    * Controller Methods
    */

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

        return redirect()->back()->with("success", "Password changed successfully!");
    }

    public function showRecoverPasswordForm() {
        return view('auth.recoverPassword');
    }

    public function recoverPassword(Request $request) {
        $users = User::all();
        $selected;
        foreach ($users as $user) {
        	if ($user->username == $request->get('username')) {
        		$selected = $user;
        	}
        }

        if ($selected->question == $request->get('question') && $selected->answer == $request->get('answer')) {
            $selected->password = bcrypt($request->get('new_password'));
            $selected->save();
            return redirect()->route('main');
        } else {
            return redirect()->back()->with("danger", "One or more parameters are incorrect.");
        }
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
    
    public function showDetails() {
        return view('showDetails');
    }

    public function purchases(){
        $user = Auth::user()->username;
        $purchases = Transactions::where('buyer', $user)->where('status', 'sold')->get();
       
        return response()->view('purchases',[
            'purchases' => $purchases]);
    }

    public function sales(){
        $user = Auth::user()->username;
        $sales = Transactions::where('seller', $user)->where('status', 'sold')->get();

        return response()->view('sales',[
            'sales' => $sales]);
    }

    public function userList() {
        $users = User::withTrashed()->get();

        return response()->view('userList', ['users' => $users]);
    }

    public function deleteUser($id) {
        $user = User::find($id);
        $user->delete();

        return redirect()->back();
    }
}
