<?php
    namespace App\Classes;
    /**
     * This is a sample class to send sms using ego sms api
     * @author Barakhubs <markbrightbaraka@gmail.com>
     */
    class Sms {
        public function SendSMS ($username, $password, $sender, $number, $message){
            $url = "www.egosms.co/api/v1/plain/?";

            $parameters = "number=[number]&message=[message]&username=[username]&password=[password]&sender=[sender]";
            $parameters = str_replace("[message]", urlencode($message) , $parameters);
            $parameters = str_replace("[sender]", urlencode($sender) , $parameters);
            $parameters = str_replace("[number]", urlencode($number) , $parameters);
            $parameters = str_replace("[username]", urlencode($username) , $parameters);
            $parameters = str_replace("[password]", urlencode($password) , $parameters);
            $live_url = "https://" . $url . $parameters;
            $parse_url = file($live_url);
            $response = $parse_url[0];
            return $response;
        }
    }

?>
