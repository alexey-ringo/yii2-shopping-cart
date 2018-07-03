<?php
namespace frontend\controllers;

use frontend\models\Product;
use frontend\models\Cart;
use Yii;

/**
 * Cart controller
 */
class CartController extends AppController {
    
    public function actionAdd() {
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
    
}