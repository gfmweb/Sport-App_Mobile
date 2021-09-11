<?php

namespace controllers;

use models\UserDB;

class testController
{
    public function index($params = null){
        if(isset($params[0]['val'])){
            $result=UserDB::modeAPP($params[0]['val']);
            echo'<pre>'; print_r($result); echo'</pre>';
        }

    }
}