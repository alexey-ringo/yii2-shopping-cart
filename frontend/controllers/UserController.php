<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\users\Signup;
use frontend\models\users\Login;

class UserController extends Controller
{
    public function actionLogin()
    {
        $model = new Login();
        if($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect(['category/index']);
        }
    
        return $this->render('login', [
            'model' => $model,
            ]);
    }

    public function actionSignup()
    {
        $model = new Signup();
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Пользователь зарегистрирован!');
            $this->redirect(['category/index']);
        }
        return $this->render('signup', [
            'model' => $model,
            ]);
    }
    
    public function actionLogout() {
        Yii::$app->user->logout();
        
        //return $this->redirect(['site/index']);
        return $this->goHome();
    }

}
