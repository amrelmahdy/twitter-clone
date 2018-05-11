<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Session;
use Validator;
use Super;

class ProfileController extends Controller
{

    public function profile($username){
        $user = User::where('username', $username)->first();
        if(!$user){
            abort(404);
        }
        return view('pages.profile', compact('user'));
    }

    public function setAvatar(Request $request){
        $rules = [
            'image' => 'required'
        ];

        $validator  = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator);
        }

        $image = Super::uploadFile($request->image, 'images/profiles');

        if(!$image){
            Session::flash('error', 'whoops !!, error uploading avatar ..');
            return redirect()->back();
        }

        $user = $request->user();

        $user->image = $image;
        $user->update();

        return redirect()->back();
    }
}

