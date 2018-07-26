<?php
namespace frontend\controllers\behaviors;

use Yii;
use yii\base\Behavior;

//Для описания событий поведения контроллера:
use yii\web\Controller;

class AccessBehavior extends Behavior {
    //Привязали обработчик к событию контроллера
    public function events() {
        return [
            Controller::EVENT_BEFORE_ACTION => 'checkAccess'
            ];
    }
    
    public function checkAccess() {
        if(Yii::$app->user->isGuest) {
            return Yii::$app->controller->redirect(['user/login']);
        }
    }
    
}
