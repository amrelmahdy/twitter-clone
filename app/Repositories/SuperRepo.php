<?php
namespace App\Repositories;
use App\Traits\NotificationTrait;
use App\Traits\QueueFirebaseTrait;
use App\Traits\SuperTrait;
use App\Traits\FileTrait;
use App\Traits\DateTrait;

class SuperRepo{
    use SuperTrait, FileTrait, DateTrait, NotificationTrait , QueueFirebaseTrait;
}