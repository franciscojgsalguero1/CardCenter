<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Transactions;
use App\User;
use Auth;

class HomeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }
}