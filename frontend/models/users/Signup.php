<?php

namespace frontend\models\users;

use Yii;
use yii\base\Model;
use frontend\models\User;

class Signup extends Model {
    
    public $username;
    public $email;
    public $password;
    
    public function rules()
    {
        return [
            ['username', 'trim'], //Обрезка пробелов по краям
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            //unique - валидатор на уникальность yii\validators\UniqueValidator
            //targetClass - класс, к которому нужно обратиться для проверки на уникальность записи
            //т.е. - в какой таблице в БД нужно проверять уникальность записи
            //[['username'], 'unique', 'targetClass' => User::className()],
            
            ['email', 'trim'], //Обрезка пробелов по краям
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            //unique - валидатор на уникальность yii\validators\UniqueValidator
            //targetClass - класс, к которому нужно обратиться для проверки на уникальность записи в БД
            [['email'], 'unique', 'targetClass' => User::className()],
            
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            
        ];
    }
    
    public function save() {
  
        if($this->validate()) {
            $user = new User();
            //$this-email и $this-username - позьзоваьельские данные, загруженные из ActiveForm с помощью load()
            $user->email = $this->email;
            $user->username = $this->username;
            //Метка времени на момент создания пользователя - всегда одинаковая в created и updated
            $user->created_at = $time = time();
            $user->updated_at = $time;
            //Будет записана сгенерированая случайная строка
            $user->auth_key = Yii::$app->security->generateRandomString();
            //Хэшируем полученный от пользователя пароль (загруженный из ActiveForm $this->password)
            $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            
            if ($user->save()) {
                
                //Место успешной регистрации нового пользователя
                return $user;
            }         
        }
        return false;
    }
}