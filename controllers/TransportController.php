<?php


namespace controllers;


class TransportController
{
    public static function FindByPhone($phone){
        $param =['Phone'=>$phone];
        $options=[

            "Method"=>"getClientByPhone",
            "Parameters"=>$param,
            "ClubId"=>"037e7313-3676-11e9-983e-0050568bd50c",
            "Request_id"=>"2f7a1737-de2b-455e-b897-93e252d26909"
        ];

        $ch = curl_init('http://81.30.209.224:34560/fitness/hs/api/v1/');
        curl_setopt($ch, CURLOPT_USERPWD, 'ExchangePF:Htcehc0410');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($options));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $html = curl_exec($ch);

        $response=json_decode($html,true);
        curl_close($ch);



        return $response;
    }

    public static function getRelatives($ClientID){
        $param =['ClientID'=>$ClientID];
        $options=[

            "Method"=>"GetRelativesDescription",
            "Parameters"=>$param,
            "ClubId"=>"037e7313-3676-11e9-983e-0050568bd50c",
            "Request_id"=>"2f7a1737-de2b-455e-b897-93e252d26909"
        ];

        $ch = curl_init('http://81.30.209.224:34560/fitness/hs/api/v1/');
        curl_setopt($ch, CURLOPT_USERPWD, 'ExchangePF:Htcehc0410');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($options));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $html = curl_exec($ch);

        $response=json_decode($html,true);
        curl_close($ch);



        return $response;
    }


}