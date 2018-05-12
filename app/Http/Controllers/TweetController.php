<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Super;
use Validator;

class TweetController extends Controller
{
    public function create(Request $request){
        $rules = [
            'tweet' => 'required'
        ];

        $validator  = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return Super::jsonResponse(false, 503, 'Error in validation', $validator->errors(), new \stdClass());
        }

        $tweet = Tweet::create([
            'tweet' => $request->tweet,
            'user_id' => $request->user()->id
        ]);

        if(!$tweet){
            return Super::jsonResponse(false, 500, 'Error adding tweet', [],  new \stdClass());
        }

        return Super::jsonResponse(true, 200, 'tweet added..', [], $tweet);
    }

    public function reloadTweets($id = NULL){
        if($id === NULL){
            $tweets = User::timelineTweets();
        } else {
            $tweets = Auth::user()->tweets;
        }
        return View('includes.tweets', compact('tweets'));
    }

    public function favouriteTweet(Request $request){
        $rules = [
            'tweet_id' => 'required',
            'status' => 'required',
        ];

        $validator  = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return Super::jsonResponse(false, 503, 'Error in validation', $validator->errors(), new \stdClass());
        }
        try{
            if($request->status == 1) {
                $request->user()->favourites()->attach([$request->tweet_id]);
            } else {
                $request->user()->favourites()->detach([$request->tweet_id]);
            }
        }catch (\Exception $ex){
            return Super::jsonResponse(false, 500, $ex->getMessage(), [],  new \stdClass());
        }

        return Super::jsonResponse(true, 200, 'tweet favourite ..', [], new \stdClass());
    }

    public function reloadTweetInfo($tweet_id){
        $tweet = Tweet::find($tweet_id);
        return View('includes.tweets-icons', compact('tweet'));
    }

    public function reloadUserInfo(){
        return View('includes.about-user', compact('tweets'));
    }
}
