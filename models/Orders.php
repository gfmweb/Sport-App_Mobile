<?php


namespace models;


use core\db\CRUD;

class Orders
{
    public static function getDayOrders(){
        $DB = new CRUD('Orders');
        $date = date('Y-m-d');

        $str='SELECT order_address as address, order_time as time, order_body as items, order_summ as summ FROM Orders WHERE order_date = \''.$date.'\' ORDER BY id DESC';

        $result['content'] = $DB->FreeInfo($str,[])->Resulting;
        for ($i=0,$imax=count($result['content']); $i < $imax; $i++){
            $result['content'][$i]['items'] = json_decode($result['content'][$i]['items'],true);
            $time = explode(' ',$result['content'][$i]['time']);
            $result['content'][$i]['time']=$time[1];
            $result['content'][$i]['summ'] = $result['content'][$i]['summ'].' '.APP_Curency;
        }
        $str = 'SELECT * FROM exc WHERE status = 1';
        $rest = $DB->FreeInfo($str,[])->Resulting;

        if((isset($rest[0]['status']))){
            $result['status']='NEW';
            $str = 'UPDATE exc SET status =0 WHERE 1';
            $DB->FreeInfo($str,[]);
        }
        else{
            $result['status']='Norm';
        }

        return $result;
    }
}