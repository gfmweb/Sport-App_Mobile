<?php


namespace controllers;


use core\db\CRUD;

class CreateController
{
    public function index($params = null){
        $order_date = date ('Y-m-d');
        $order_date_time = date ('Y-m-d H:i:s');
        $data = htmlspecialchars_decode($params[0]['val']);
        $info =json_decode(htmlspecialchars_decode($data),true);
        $body = json_encode($info['body'],JSON_UNESCAPED_UNICODE);
        $table = $info['table'];
        $summ=0;
        for($i=0,$imax=count($info['body']); $i < $imax; $i++){
            $summ=$summ+($info['body'][$i]['amount']*$info['body'][$i]['price']);
        }

        $DB = new CRUD('Orders');
        $str = 'INSERT INTO Orders SET order_time = :timer, order_date =:dater, order_address =:address, order_body=:bodyr, order_summ=:order_summ';
        $result = $DB->FreeInfo($str,['timer'=>$order_date_time,'dater'=>$order_date,'address'=>$table, 'bodyr'=>$body,'order_summ'=>$summ]);

        $str = 'UPDATE exc SET status =1 WHERE 1';
        $DB->FreeInfo($str,[]);
    }


}