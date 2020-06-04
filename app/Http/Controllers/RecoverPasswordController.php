<?php

namespace App\Http\Controllers;

use App\lain;
use Illuminate\Http\Request;
use App\User;

class RecoverPasswordController extends Controller {
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
}