<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    public function getImageAttribute($value)
    {
        if (strpos($value, '/') !== false) {
            return $value;
        }
        return asset('images/profiles/' . $value);
    }


    public function followings()
    {
        return $this->hasMany(Follow::class, 'user_follow_id', 'id');
    }

    public function followers()
    {
        return $this->hasMany(Follow::class, 'user_followed_id', 'id');
    }

    public function tweets()
    {
        return $this->hasMany(Tweet::class)->orderBy('created_at', 'desc');
    }



    public static function timelineTweets()
    {
        $tweets = Tweet::where(function ($query) {
            $query->orWhereIn('user_id', Auth::user()->followings->pluck('user_followed_id'));
            //$query->orWhereIn('user_id', $this->followers->pluck('user_follow_id'));
            $query->orWhere('user_id', Auth::user()->id);
        })->orderBy('created_at', 'desc')->get();
        return $tweets;
    }


    public function usersToFollow(){
        $users = $this->whereNotIn('id', Auth::user()->followings->pluck('user_followed_id'))
            ->whereNotIn('id', Auth::user()->followers->pluck('user_follow_id'))
            ->where('id', '<>',Auth::user()->id)
            ->get();

        return $users;
    }

    public function is_following($username){
        $user = $this->where('username', $username)->first();
        if(!$user){
            return false;
        }
        $is_following = Follow::where('user_follow_id', Auth::user()->id)
                              ->where('user_followed_id', $user->id)
                              ->first();

        if(!$is_following){
            return false;
        }

        return true;
    }
}
