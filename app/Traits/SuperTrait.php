<?php

namespace App\Traits;

use App\Mail\Mailer;
use App\Models\Job;
use App\Models\JobUser;
use App\Models\Notification;
use Image;
use File;
use Mail;
use App\Models\User;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use Carbon\Carbon;
use App;
use Session;
use App\Models\Setting;
use Zend\Diactoros\Request;

trait SuperTrait
{

    public function generatePassword($size = 8)
    {
        $p = openssl_random_pseudo_bytes(ceil($size * 0.67), $crypto_strong);
        $p = str_replace('=', '', base64_encode($p));
        $p = strtr($p, '+/', '^*');
        return substr($p, 0, $size);
    }

    public function randomPin()
    {
        return rand(1111, 9999);
    }

    public function shortenText($string, $wordsreturned)
    {
        $string = strip_tags($string);
        $retval = $string;
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);
        if (count($array) <= $wordsreturned) {
            $retval = $string;
        } else {
            array_splice($array, $wordsreturned);
            $retval = implode(" ", $array) . " ...";
        }
        return $retval;
    }

    function trim_text($input, $length, $ellipses = true, $strip_html = true)
    {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }

        return $trimmed_text;
    }

    public function validate($rules, $request)
    {
        if (is_array($rules)) {
            foreach ($rules as $rule) {
                if (!$request[$rule]) {
                    return response()->json([
                        'Error' => ['type' => 'fail', 'desc' => $rule . ' is_required', 'code' => 11],
                        'Response' => new \stdClass()
                    ]);
                }
            }
        }
    }

    public function jsonResponse($status, $error_code, $message ,$validation, $response)
    {
        return response()->json([
            'Error' => [
                'status' => $status,
                'code' => $error_code,
                'validation' => $validation,
                'desc' => $message,

            ],
            'Response' => $response,
        ], 200);
    }

    public function getProperty($value)
    {
        if (!$value || $value == null) {
            echo 'N/A';
        } else {
            echo $value;
        }
    }

    public function calculateDueAmount($systems, $plan){
        $due_amount = 0;
        if(!is_array($systems)){
            return false;
        }
        foreach ($systems as $system){
            $due_amount += $plan->price;
        }
        return $due_amount;
    }

}