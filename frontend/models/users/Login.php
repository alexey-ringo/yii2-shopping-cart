<?php

namespace frontend\models\users;

use Yii;
use yii\base\Model;
use frontend\models\User;

class Login extends Model {
    
    public $username;
    public $email;
    public $password;
    
    public function rules()
    {
        return [
            ['email', 'trim'], //Обрезка пробелов по краям
            ['email', 'required'],
            ['password', 'required'],
            //мой собственный кастомный валидатор validatePassword
            ['password', 'myValidatePassword'],
           
            
        ];
    }
    
    public function login() {
        if($this->validate()) {
            $user = User::findUserbyEmail($this->email);
            return Yii::$app->user->login($user);
        }
    }
    
    //Реализация логики работы моего собственного валидатора myValidatePassword
    //$attribute - назвение поля, для которого будет производиться валидация
    //В данном случае в $attribute будет передаваться строка 'password'
    public function myValidatePassword($attribute, $params) {
        //Найдем зарегистрированного пользователя по полученному из ActiveForm email
        $user = User::findUserbyEmail($this->email);
        if(!$user || !$user->validatePassword($this->password)) {
            //Собственные валидаторы ничего не возврящают,
            //а только генерируют инф об ошибке
            $this->addError($attribute, 'Неправильный пароль');
                
            }
        
    }
}