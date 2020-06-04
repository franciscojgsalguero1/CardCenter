<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Mail\WelcomeMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct() {
        $this->middleware('guest');
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'username' => ['required', 'string', 'min:8', 'max:20', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'surname' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:255'],
            'street_num' => ['required', 'string', 'max:8'],
            'question' => ['string'],
            'answer' => ['required', 'string', 'max:50'],
            'street_num' => ['required', 'string', 'max:8'],
            'post_code' => ['required', 'string', 'max:8'],
            'city' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:43'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data) {
        //$this->sendmail($data);
        return User::create([
            'username' => $data['username'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'question' => $data['question'],
            'answer' => $data['answer'],
            'street' => $data['street'],
            'street_num' => $data['street_num'],
            'post_code' => $data['post_code'],
            'city' => $data['city'],
            'country' => $data['country'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function update($name, $password1) {
        User::where('email', $name)->update(['password', hass::make($password1)]);
    }

    private function sendmail(array $data) {
        $contents = ([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'username' => $data['username']
        ]);
        Mail::to($data['email'])->send(new WelcomeMail ($contents));
    }
}