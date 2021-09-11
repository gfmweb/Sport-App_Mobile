<?php


namespace controllers;


class QRIController
{
    public function index($params = null){
        require_once 'core/qrsimple/qrlib.php';
        $text = null;
        $logo = false;
        $logosrc = false;
        foreach ($params as $item){
            if($item['param']=='data'){
                $text=$item['val'];
            }

        }



        if ($logo){
        \QRcode::png($text, __DIR__ . '/tmp.png', 'H', 6, 2);
        /* Конвертация PNG8 в PNG24 */
        $im = imagecreatefrompng(__DIR__ . '/tmp.png');

        $width = imagesx($im);
        $height = imagesy($im);

        $dst = imagecreatetruecolor($width, $height);
        imagecopy($dst, $im, 0, 0, 0, 0, $width, $height);
        imagedestroy($im);

        /* Наложение логотипа */

        $logo_width = imagesx($logo);
        $logo_height = imagesy($logo);

        $new_width = $width / 3;
        $new_height = $logo_height / ($logo_width / $new_width);

        $x = ceil(($width - $new_width) / 2);
        $y = ceil(($height - $new_height) / 2);

        imagecopyresampled($dst, $logo, $x, $y, 0, 0, $new_width, $new_height, $logo_width, $logo_height);
        unlink(__DIR__ . '/tmp.png');

        /* Вывод в браузер */
        header('Content-Type: image/x-png');
        imagepng($dst);

        }
        else{
            \QRcode::png($text,false,'L',6,4,false);
        }
    }




}