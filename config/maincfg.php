<?php
/**
 *  Основной конфигурационный файл приложения
 *
 */
return
    [
        'APP'   =>  [
                        'Name'          =>  'Persona Sport',
                        'Language'      =>  'ru-RU',
                        'Curency'       =>  '₽',
                        'Mode'          =>  'DEV'
                    ],
        'DB'    =>  [
                        'Host'          =>  'localhost',
                        'Base'          =>  'admin_sport',
                        'User'          =>  'admin_sport',
                        'Password'      =>  'Bhbyj4rf',
                        'CharSet'       =>  'utf8'
                    ],
        'ADMIN' =>  [
                        'Password'      =>  'Bhbyj4rf'
                    ],

        'DEFAULT' =>[
                        'Format'        => 'WEB'

                    ],

        'TOKEN'=>   [
                        'Telegram'      =>  '1681031088:AAE3ZxZStkj61LJmjfSBdOD1Bi47s4ryOAk',
                        'YandexOAUTH'   =>  'AgAAAAASRRCxAATuwfTHpFCJtE8KkIjApkN4iio',
                        'YandexMap'     =>  '03957288-6b97-4438-8f1f-e2c84ee7eade',
                        'DADATA'        =>  '94151c6926b1ad44afd591b1ad384fcce6baf16d'
                    ]
    ];