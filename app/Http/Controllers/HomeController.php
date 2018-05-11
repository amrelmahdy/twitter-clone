<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Validator;
use Super;
use Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

}