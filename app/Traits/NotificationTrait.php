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

    // pusher notification
    public function triggerPusherEvent()
    {
        $message = new \stdClass();
        $message->message = 'hello';

        $data = new \stdClass();
        $data->data = $message;
        $data->name = 'event_name';
        $data->channel = 'my-channel';

        $data = json_encode($data);
        $url = 'https://api.pusherapp.com/apps/524717/events?' . http_build_query([
                'body_md5' => '2c99321eeba901356c4c7998da9be9e0',
                'auth_version' => '1.0',
                'auth_key' => '77711f301f8da4229a30',
                'auth_timestamp' => strtotime(now()),
                'auth_signature' => hash_hmac('SHA256', "POST\n/apps/524665/events\nauth_key=f7e674f011a4b0b739a8&auth_timestamp=1526127788&auth_version=1.0&body_md5=2c99321eeba901356c4c7998da9be9e0", '97ee649bd68ba5e458ee'),
            ]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');


        $jsonResponse = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }
        curl_close($ch);

        return $jsonResponse;
    }

}
