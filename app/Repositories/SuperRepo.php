<?php
namespace App\Repositories;
use App\Traits\EmailTrait;
use App\Traits\ExceptionTrait;
use App\Traits\LangTrait;
use App\Traits\NotificationTrait;
use App\Traits\PlanTrait;
use App\Traits\QueueFirebaseTrait;
use App\Traits\SuperTrait;
use App\Traits\FileTrait;
use App\Traits\DateTrait;

class SuperRepo{
    use SuperTrait, FileTrait, DateTrait, EmailTrait, LangTrait, ExceptionTrait, NotificationTrait , PlanTrait , QueueFirebaseTrait;
}