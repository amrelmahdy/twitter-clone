<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Tweet extends Model
{

    protected $fillable = [
        'user_id',
        'tweet',
        'total_retweets',
        'image'
    ];

    protected $appends = ['tweeter'];

    // user who adds the tweet
    public function tweeter(){
        return $this->belongsTo(User::class);
    }


    // attaching
    public function getTweeterAttribute(){
        $user = User::find($this->user_id);
        if(! $user){
            return new \stdClass();
        }
        return $user;
    }

    // users who favourites
    public function users(){
        return $this->belongsToMany(Tweet::class, 'user_tweet');
    }

    // if user a tweet
    public function isFavourite(){
        $authUserFavourites = Auth::user()->favourites->pluck('id')->toArray();
        if(in_array($this->id, $authUserFavourites)){
            return true;
        }
        return false;
    }

    public function getAllFavourites(){
        $count = $this->users->count();
        return $count;
    }

}
