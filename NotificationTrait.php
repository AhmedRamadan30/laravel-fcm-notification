<?php

namespace App\Traits;

trait NotificationTrait {

    /**
     * Create a new controller instance.
     *
     * @param $tokens
     * @param $title
     * @param $body
     */
    public function sendNotification($tokens, $title, $body)
    {
        $SERVER_API_KEY = 'YOUR_API_KEY';

        $data = [

            "registration_ids" => $tokens,

            "notification" => [

                "title" => $title,

                "body" => $body,

                "sound"=> "default" // required for sound on ios

            ],

        ];

        $dataString = json_encode($data);

        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        return $response = curl_exec($ch);
    }

}
