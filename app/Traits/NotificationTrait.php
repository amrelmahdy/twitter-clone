<?php


namespace App\Traits;

use App\Mail\SuperMailer;
use App\Models\Notification;
use DB;


trait NotificationTrait
{
    public function __construct()
    {
        define('API_ACCESS_KEY', 'AAAAbgNqOPo:APA91bFBFVCSqAxgAf0QbFKDqz-jKkxg9wmF6F95svaONegyOEkR_CVNTIseDCmYObohAmLDtgCFbQGuE07DWGeJLFbPk9JnSRTXqc330HIcCPFjuKIbTeNjFQ-YgzSIFmzxarqjK-XS');
    }

    public function push_notification($title, $body, $tokens, $action, $notification)
    {
        #prep the bundle
        $notification_object = array
        (
            'title' => $title,
            'body' => $body,
            'sound' => 1,
            'click_action' => $action,
            'notification' => $notification,
            'icon' => 'assets/images/logo.png',
            'object_id' => $notification->object_id,
        );

        $data = array
        (
            'title' => $title,
            'body' => $body,
            'sound' => 1,
            'click_action' => $action,
            'notification' => $notification,
            'icon' => 'assets/images/logo.png',
            'object_id' => $notification->object_id,
            );

        $fields = array
        (

            'registration_ids' => $tokens,
            'notification' => $notification_object,
            'data' => $data,

        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );


        #Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


    public function getNotificationListWeb($type = 0, $multicast)
    {
        switch ($multicast) {
            case 2 :
                if ($type == 0) {
                    $notifications = Notification::where('multicast', 2)->where('is_read', 0)
                        ->orderBy('created_at', 'desc')
                       ->get();
                    return $notifications->count();
                } else {
                    $notifications = Notification::where('multicast', 2)
                        ->orderBy('created_at', 'desc')
                        ->get();
                }
                return $notifications;
                break;
            default:
                return false;
        }
        return $notifications;
    }

}
