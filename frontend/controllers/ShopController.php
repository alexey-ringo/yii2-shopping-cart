<?php
namespace frontend\controllers;

//use frontend\Controller;
use Yii;
//use yii\filters\VerbFilter;

class ShopController extends AppController
{
    /*
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'add-in-cart' => ['post'],
                    //'set-count' => ['post'],
                    //'delete-from-cart' => ['post'],
                    'add-in-cart' => ['get'],
                    'set-count' => ['get'],
                    'delete-from-cart' => ['get'],
                ],
            ],
        ]);
    }
    */

    public function actionAddInCart()
    {
        /*
        $postData = Yii::$app->request->post();
        return json_encode([
            'success' => Yii::$app->cart->add($postData['product_id'], $postData['count']),
            'cartStatus' => Yii::$app->cart->status
        ]);
        */
        //id добавляемого в карту товара
        $id = Yii::$app->request->get('id');
        //приводим пришедшее значение о кол-ве к числу
        $qty = (int)Yii::$app->request->get('qty');
        //если пришло false - устанавливаем 1, иначе реальное пришедшее значение qty
        $qty = !$qty ? 1 : $qty;
        
        if (Yii::$app->cart->add($id, $qty)) {
        
            //Если запрос пришел не AJAX-методом, 
            //то возвращаем пользователя на страницу, с которой он пришел
            if(!Yii::$app->request->isAjax) {
                return $this->redirect(Yii::$app->request->referrer);
            }
            return true;
        }
        
        return false;
        
    }

    public function actionSetCount()
    {
        $postData = Yii::$app->request->post();
        return json_encode([
            'success' => Yii::$app->cart->setCount($postData['product_id'], $postData['count']),
            'cartStatus' => Yii::$app->cart->status
        ]);
    }

    public function actionDeleteFromCart()
    {
        $postData = Yii::$app->request->post();
        return json_encode([
            'success' => Yii::$app->cart->delete($postData['product_id']),
            'cartStatus' => Yii::$app->cart->status
        ]);
    }
}