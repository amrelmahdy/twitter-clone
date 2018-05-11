<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use Illuminate\Http\Request;
use Validator;
use Super;

class FollowController extends Controller
{
    public function follow(Request $request){
        $rules = [
            'user_id' => 'required'
        ];

        $validator  = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return Super::jsonResponse(false, 503, 'Error in validation', $validator->errors(), new \stdClass());
        }

        $follow = Follow::create([
            'user_follow_id' => $request->user()->id,
            'user_followed_id' => $request->user_id,
        ]);

        if(!$follow){
            return Super::jsonResponse(false, 500, 'Error adding tweet', [],  new \stdClass());
        }

        return Super::jsonResponse(true, 200, 'user followed..', [], $follow);

    }

    public function reloadWhoToFollow(Request $request){
        $users = $request->user()->usersToFollow()->take(3);
        return View('includes.user-to-follow', compact('users'));
    }
}
