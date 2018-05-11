<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateTrait
{
    public function readableDate($date_from)
    {
        $result = Carbon::createFromTimeStamp( strtotime($date_from),"Africa/Cairo" )->diffForHumans();
        return $result;
    }
    public function getNiceDate($date, $format = 'Y D M'){
        return Carbon::parse($date)->format($format);
    }
    public function getDatabaseDate($date, $format = 'Y-m-d'){
        return Carbon::parse($date)->format($format);
    }
    public function getNiceTime($time, $format = 'g:i A'){
        return Carbon::parse($time)->format($format);
    }
}