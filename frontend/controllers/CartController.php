<?php
namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\Cart;
use Yii;

/**
 * Cart controller
 */
class CartController extends AppController {
    
    //Добавление товара в корзину (with show modal Cart)
    public function actionAdd() {
        //id добавляемого в карту товара
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        if(empty($product)) {
            return false;
        }
        
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product);
        /*
        debug($session['cart']);
        debug($session['cart.qty']);
        debug($session['cart.sum']);
        */
        //Модальному окну корзины не нужен html-шаблон
        $this->layout = false;
        
        return $this->render('cart-modal',[
            'session' => $session,
            ]);
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
        
        return $this->render('cart-modal',[
            'session' => $session,
            ]);
        
    }
    
}