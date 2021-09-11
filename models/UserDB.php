<?php


namespace models;
use controllers\TransportController;
use core\db\CRUD;

class UserDB
{
    public static function FindUserByPhone($phone){
        $DB = new CRUD('user');
        $str = 'SELECT userName as Name, UserPatronymic as Patronymic, UserLastName as LastName, UserBirthday as Birsthday, UserTarget as Target FROM `user` WHERE UserPhone =:phone';
        $needle=['phone'=>$phone];
        $result = $DB->FreeInfo($str,$needle)->Resulting;
        if(!isset($result[0]['Name'])){ // Если не найден в своей БД, то Пытаемся найти его в 1с
           $OneSResult = TransportController::FindByPhone($phone);
           if (isset($OneSResult['Parameters']['ClientID'])){ //Если нашелся клиент с таким номером телефона в 1с то Пробуем записать его в БД
                $Relatives = TransportController::getRelatives($OneSResult['Parameters']['ClientID']);

                return $Relatives;
           }

        }
        else{
            $result = $result[0];
        }



        return $result;
    }

    public static function CreateUpdateUser($phone,$token){
        $DB = new CRUD('user');
        // Попытка найти этот номер телефона
        $result = $DB->FreeInfo('SELECT id FROM user WHERE UserPhone=:phone',['phone'=>$phone])->Resulting;
        if (isset($result[0]['id'])){ // Если такой пользователь есть, то будем его обновлять
            $DB->FreeInfo('UPDATE user SET Token=:token WHERE id=:id',['token'=>$token,'id'=>$result[0]['id']]);
            return true;
        }
        else{
            $DB->FreeInfo('INSERT INTO user SET Token =:token, UserPhone =:phone',['token'=>$token,'phone'=>$phone]);
        }
    }

    public static function GetUserBYToken($token){
        $DB = new CRUD('user');
        $result = $DB->FreeInfo('SELECT 
        user.UserName as Name, 
        user.UserPatronymic as  Patronymic,
        user.UserLastName as LastName,
        user.UserBalance as Balance,
        user.UserBirthday as Birthday,
        user.UserCart as Cart,
        user.ClubID, 
        user.UserNotifications as Notifications,
        user.PersonalCards as UserCards
         FROM user  WHERE user.Token =:token',
        ['token'=>$token]
        )->Resulting;
        if(isset($result[0])){
            if(!is_null($result[0]['ClubID'])) {
                $club = $DB->FreeInfo('SELECT id, ClubName FROM club WHERE id=:id', ['id' => $result[0]['ClubID']])->Resulting[0];
                $result[0]['Active_CLUB'] = $club;
            }
            else{
                $result[0]['Active_CLUB']['id']=0;
                $result[0]['Active_CLUB']['ClubName']='Клуб не выбран';
            }
            return $result[0];
        }
        else{
            return 'Пользователь не найден';
        }
    }

    public static function getUserParam($config){
        $Token = $config['Token'];
        $query = $config['Param'];
        $DB = new CRUD('user');
        $result = $DB->FreeInfo('SELECT * FROM user WHERE Token=:Token',['Token'=>$Token])->Resulting;

        if(isset($result[0])){
            if(isset($result[0][$query])){
                return ['status'=>200,'message'=>'ok','value'=>$result[0][$query]];
            }
            else{
                return ['status'=>404,'message'=>'У объекта нет свойства '.$query,'value'=>null];
            }

        }
        else{
            return ['status'=>404,'message'=>'Токен не найден','value'=>null];
        }

    }

    public static function setUserParam($config){
        $Token = $config['Token'];
        $query = $config['Param'];
        $value = $config['Value'];
        $DB = new CRUD('user');
        $check = $DB->FreeInfo('SELECT id FROM user WHERE Token=:token',['token'=>$Token])->Resulting;
        if(isset($check[0]['id'])) {
            $DB->FreeInfo('UPDATE user SET '.$query.' =:newvalue WHERE Token=:Token', ['newvalue' => $value, 'Token' => $Token]);
            return ['status'=>200,'message'=>'Параметр '.$query. ' Был успешно обновлен ','value'=>$value];
        }
        else{
            return ['status'=>404,'message'=>'Токен не найден','value'=>null];
        }
    }

    public static function removeUser($phone){
		echo'<pre>'; print_r($phone); echo'</pre>';
		$DB = new CRUD ('user');
		$DB->FreeInfo('DELETE FROM user WHERE UserPhone ='.$phone,[]);
		return true;
        
    }
}