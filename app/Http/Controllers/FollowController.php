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


        try{
            $request->user()->followings()->attach([$request->user_id]);
        }catch (\Exception $ex){
            return Super::jsonResponse(false, 500, 'Error following user', [],  new \stdClass());
        }

        return Super::jsonResponse(true, 200, 'user followed..', [], new \stdClass());

    }

    public function reloadWhoToFollow(Request $request){
        $users = $request->user()->usersToFollow()->take(3);
        return View('includes.user-to-follow', compact('users'));
    }
}
