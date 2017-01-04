<?php




    /**
     *  @package: IonicPush
     *  @author: Eftal Yurtseven
     *  @uri: https://github.com/eftalyurtseven/ionicPushClass
     *  @version: 0.1
     *
     */

    class IonicPush {

        protected $profileName;

        protected $pushAuthKey;

        protected $tokens;

        protected $notifyConfig;

        public $err;

        /**
         *
         *  @param: SettingArray
         *
        */

        public function __construct ($SettingArray){

            if ( is_array( $SettingArray ) )  {
                self::setProfile($SettingArray['profileName']);
                self::setAuth($SettingArray['AuthKey']);
            } else {

                throw new Exception("You need to send an array for the initiator method");

            }

        }

        /**
         *
         * @param str
         *
         * */

        private function setProfile ( $str ){

            $this -> profileName = $str;

        }

        /**
         *
         * @param str
         *
         * */

        private function setAuth ( $str ){

            $this -> pushAuthKey = $str;

        }

        /**
         *
         * @param deviceTokens
         *
         * */

        public function getDevices( array $deviceTokens ){

            if ( is_array( $deviceTokens ) ) {

                $this -> tokens = $deviceTokens;

            }

        }

        /**
         *
         * @param array
         *
         * */

        public function setNotificationArray ( array $notConf ){

            if ( is_array( $notConf ) ) {

                $this -> notifyConfig = $notConf;

            }

        }

        /**
         *
         * @return json, string
         *
         * */

        private function config (  ) {

            $configArray = [

                'tokens' => $this -> tokens,
                'profile' => $this -> profileName,
                'notification' => $this -> notifyConfig,


            ];

            return json_encode($configArray);

        }

        /**
         *
         * @param authToken
         * @return CURLHeader
         *
         * */

        private function setHeader ( $authToken ){

           if ( $authToken ) {
               $headerConf = [

                   'Content-Type: application/json',
                   'Authorization: Bearer ' . $authToken

               ];
           }

            return $headerConf;

        }


        /**
         *
         *
         * @return result
         *
         * */

        public function send (  ) {

            $ch = curl_init('https://api.ionic.io/push/notifications');
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, self::config());
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, self::setHeader($this -> pushAuthKey));
            $result = curl_exec($ch);

            $arr = json_decode($result);
            if ($arr->meta->status == 201){
                return true;
            }else {
                $this -> err = $arr -> error;
                return false;
            }

        }





    }

