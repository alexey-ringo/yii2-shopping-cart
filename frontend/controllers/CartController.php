<?php
namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\Cart;
use frontend\models\Order;
use frontend\models\OrderItems;
use Yii;

/**
 * Cart controller
 */
class CartController extends AppController {
    
    //Добавление товара в корзину (with show modal Cart)
    /*public function actionAdd() {
        //id добавляемого в карту товара
        $id = Yii::$app->request->get('id');
        //приводим пришедшее значение о кол-ве к числу
        $qty = (int)Yii::$app->request->get('qty');
        //если пришло false - устанавливаем 1, иначе реальное пришедшее значение qty
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if(empty($product)) {
            return false;
        }
        
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        
        //Если запрос пришел не AJAX-методом, 
        //то возвращаем пользователя на страницу, с которой он пришел
        if(!Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        //Модальному окну корзины не нужен html-шаблон
        $this->layout = false;
        return $this->render('cart-modal',[
            'session' => $session,
            ]);
    }
    */
    
    public function actionAdd() {
         //id добавляемого в карту товара
        $id = Yii::$app->request->get('id');
        //приводим пришедшее значение о кол-ве к числу
        $qty = (int)Yii::$app->request->get('qty');
        //если пришло false - устанавливаем 1, иначе реальное пришедшее значение qty
        $qty = !$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if(empty($product)) {
            return false;
        }
        
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        if ($cart->addToCart($product, $qty)) {
        
            //Если запрос пришел не AJAX-методом, 
            //то возвращаем пользователя на страницу, с которой он пришел
            if(!Yii::$app->request->isAjax) {
                return $this->redirect(Yii::$app->request->referrer);
            }
            return true;
        }
        
        return false;
    }
    
    //Полная очистка корзины
    public function actionClear() {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        
        return $this->render('cart-modal',[
            'session' => $session,
            ]);
    }
    
    //Удаление из корзины выбранного товара
    public function actionDelItem() {
        //id удаляемого из карты товара
        $id = Yii::$app->request->get('id');
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        //удаление товара с id и пересчет корзины
        $cart->recalc($id);
        $this->layout = false;
        
        return $this->render('cart-modal',[
            'session' => $session,
            ]);
    }
    
    //Show modal Cart
    public function actionShow() {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        
        return $this->render('view-modal',[
            'session' => $session,
            ]);
        
    }
    
    //Show html Cart - begin to order
    public function actionView() {
        $session = Yii::$app->session;
        $session->open();
        $this->setMeta('Корзина');
        //Создаем объект заказа
        $order = new Order();
        if($order->load(Yii::$app->request->post())) {
            $order->qty = $session['cart.qty'];
            $order->qty = $session['cart.sum'];
            if($order->save()) {
                //сохраняем все товары в рамках данного заказа с указанием id-заказа
                $order->saveOrderItems($session['cart'], $order->id);
                Yii::$app->session->setFlash('success', 'Ваш заказ принят. Менеджер скоро свяжется с Вами');
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }
            else {
                Yii::$app->session->setFlash('success', 'Ошибка оформления заказа');
            }
        }
        return $this->render('view',[
            'session' => $session,
            'order' => $order,
            ]);
    }
}