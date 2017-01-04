# PHP Ionic Push Class

It allows you to send notifications you created via Apps.ionic.io with *PHP*.

## Usage

   *Ionic Profile Name* and * Auth Key * required for construction function.

```php
$setArray =  [
'profileName' => 'your-profile-name',
'AuthKey' => 'your-auth-key'
];
```

 * Set your devices *

```php
$devices = ['your-device-tokens'];
```
```php
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
```

### Everything's ready, let's call the class now

```php
$IonicPush = new IonicPush($setArray);
$IonicPush -> getDevices($devices);
$IonicPush -> setNotificationArray($notifyConfig);
if ($IonicPush -> send()){
    echo 'Push sent!';
}else {
    print_r (  $IonicPush -> err );
}
```
