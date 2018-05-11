<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{

    protected $fillable = ['user_follow_id', 'user_followed_id'];


    public function follower(){
        return $this->belongsTo(User::class);
    }

    public function following(){
        return $this->belongsTo(User::class);
    }
}
