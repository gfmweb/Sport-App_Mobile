<?php
/**
 * Правила регистрации пользователя
 *
 *
 *
 */

return [
            ['phone'=>
                [
                    'pattern'=>null,
                    'type'=>'phone',
                    'validate'=>true,
                    'validate_type'=>'text',
                    'required'=>true,
                    'validate_required'=>true,
                    'placeholder'=>'Ваш номер'
                ]
            ],
            ['email'=>
                [
                    'pattern'=>null,
                    'type'=>'email',
                    'validate'=>true,
                    'validate_type'=>'link',
                    'required'=>true,
                    'validate_required'=>false,
                    'placeholder'=>'Ваш Email'
                ]

            ],
            ['password'=>
                [
                    'type'=>'password',
                    'placeholder'=>'Пароль',
                    'repete'=>true
                ]

    ],
            ['GEO'=>true],
            ['PUSH'=>true]

       ];