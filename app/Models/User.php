<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // handling avatar url issue
    public function getImageAttribute($value)
    {
        if (strpos($value, '/') !== false) {
            return $value;
        }
        return asset('images/profiles/' . $value);
    }

    // list of users follow us
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_follow_id', 'user_id')->withTimestamps();
    }

    // list of users we follow
    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id','user_follow_id')->withTimestamps();
    }

    // list of user's tweets
    public function tweets()
    {
        return $this->hasMany(Tweet::class)->orderBy('created_at', 'desc');
    }

    // tweets to appear in my timeline
    public static function timelineTweets()
    {
        $tweets = Tweet::where(function ($query) {
            $query->orWhereIn('user_id', Auth::user()->followings->pluck('id'));
            //$query->orWhereIn('user_id', $this->followers->pluck('user_follow_id'));
            $query->orWhere('user_id', Auth::user()->id);
        })->orderBy('created_at', 'desc')->get();
        return $tweets;
    }

    // list of users to follow
    public function usersToFollow(){
        $users = $this->whereNotIn('id', Auth::user()->followings->pluck('id'))
            ->where('id', '<>',Auth::user()->id)
            ->get();

        return $users;
    }

    // if a users is currently following another user
    public function is_following($username){
        $user = $this->where('username', $username)->first();
        if(!$user){
            return false;
        }
        $is_following = Follow::where('user_id', Auth::user()->id)
                              ->where('user_follow_id', $user->id)
                              ->first();

        if(!$is_following){
            return false;
        }

        return true;
    }

    // favourites tweets of a user
    public function favourites(){
        return $this->belongsToMany(User::class);
    }
}
