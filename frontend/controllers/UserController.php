<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\users\Signup;

class UserController extends Controller
{
    public function actionLogin()
    {
        return $this->render('login');
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

}
