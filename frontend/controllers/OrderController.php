<?php
namespace frontend\controllers;


use frontend\controllers\behaviors\AccessBehavior;

class OrderController extends \yii\web\Controller
{
    public function behaviors() {
        //В массиве элементы, соответствующие поведениям
        return [
            AccessBehavior::className(),
            ];
    }
    
    public function actionCreate()
    {
        return $this->render('create');
    }

    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
