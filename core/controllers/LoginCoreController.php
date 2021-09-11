<?php
/**
 * Построитель диалога регистрации
 *
 */

namespace core\controllers;



class LoginCoreController
{
    private static function config(){
        $rules = require 'config/register_rules.php'; // Забираем конфиг регистрации
        $DialogSteps = count($rules);
        $FormsInput = [];
        $Permissions = [];
        foreach ($rules as $value){ // Перебираем Массив полей и делим их на поля формы и разрешения
            foreach ($value as $el)
                if (is_array($el)){ // Если это поле формы
                    $Name = array_keys($value);
                    $row[$Name[0]] = $el;
                    $FormsInput[] = $row;
                    unset($row);
                }
                else{ // Если это разрешение
                    $Name = array_keys($value);
                    $Permissions[] = $Name;
                }
        }
        $Result['Steps'] = $DialogSteps;
        $Result['FormInputs'] = $FormsInput;
        $Result['Permissions'] = $Permissions;
        return $Result;
    }

    public static function BuildRegisterForm(){ // Построитель SSR формы регистрации (Возвращает код который будет сразу рендерится на странице)
        $Rules = self::config();
        $FormInputs = $Rules['FormInputs'];
        $Permissions = $Rules['Permissions'];
        foreach ($FormInputs as $el){
            $TemplateName = array_keys($el);
            // Проверка на поле - пароль

            $str = '<template v-if="ActiveStep=='.$TemplateName[0].'">
                        <div class="row">
                            <input type="text" v-model="FormVariables.'.$TemplateName[0].'" class="form-control"/>
                        </div>
                    </template>'.PHP_EOL;

        }

    }
    public static function InitRegistration (){ // Метод  о том какие этапы регистрации будут нужны и о том какие templates и переменные будут задействованы
        $Rules = self::config();
        $rules = require 'config/register_rules.php'; // Забираем конфиг регистрации
        return ['format'=>'JSON','DATA'=>['status'=>'success','data'=>'Initializing']];
    }
}