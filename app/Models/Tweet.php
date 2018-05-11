<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = [
        'user_id',
        'tweet',
        'total_retweets',
        'image'
    ];

    protected $appends = ['tweeter'];

    public function tweeter(){
        return $this->belongsTo(User::class);
    }


    public function getTweeterAttribute(){
        $user = User::find($this->user_id);
        return $user;
    }

}
