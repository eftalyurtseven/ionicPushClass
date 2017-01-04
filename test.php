<?php


    require_once 'autoload.php';

    $setArray =  [
        'profileName' => 'profile-name',
        'AuthKey' => 'auth-key'
    ];

    $devices = ['device-tokens'];

    $notifyConfig = [
        'title' => "Your push title",
        "message" => "your push message!",
        "android" => [
            'title' => "Your push title",
            "message" => "your push message!",
            "sound" => "your-sound-src" // default
        ],
        "ios" => [
            'title' => "Your push title",
            "message" => "Your push title",
            "sound" => "your-sound-src" // default
        ]
    ];

    $IonicPush = new IonicPush($setArray);

    $IonicPush -> getDevices($devices);

    $IonicPush -> setNotificationArray($notifyConfig);

    if ($IonicPush -> send()){
        echo 'Push Sent';
    }else {
        print_r (  $IonicPush -> err );
    }


?>