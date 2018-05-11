<?php

namespace App\Traits;


use App\Models\Account;
use App\Models\Clinic;
use App\Models\Plan;
use App\Models\User;
use DB;

trait PlanTrait
{
    public function checkAvailability($user_id , $type)
    {


        $user = User::where('role_id', 1)->where('id', $user_id)->first();
        if (!$user) {
            abort('404');
        }

        $assistants = User::where('role_id', 2)->where('account_id', $user->account_id)->count();
        $clinics = DB::table('clinics')
            ->join('users', 'clinics.created_by', 'users.id')
            ->join('accounts', 'users.account_id', '=', 'accounts.id')
            ->where('users.account_id', $user->account_id)
            ->whereIn('users.role_id', [1, 2])
            ->count();


        $account = Account::where('id', $user->account_id)->first();
        if (!$account) {
            abort('404');
        }


        $plan = Plan::where('id', $account->plan_id)->first();

        if (!$plan) {
            return false;
        }





        if($type == 1){
            if ($plan->no_of_assistants > $assistants) {
                return true;
            } else {
                return false;
            }
        }
        elseif ($type == 2){
            if ($plan->no_of_clinics > $clinics) {
                return true;
            } else {
                return false;
            }
        }
    }

}