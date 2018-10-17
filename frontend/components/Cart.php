<?php
namespace frontend\components;

use common\models\shop\Order;
use common\models\shop\OrderItems;
use yii\base\Component;
use Yii;

/**
 * Class Cart
 * @package frontend\components\cart
 * @property Order $order
 * @property string $status
 */
class Cart extends Component
{
    const SESSION_KEY = 'order_id';

    private $_order;

    public function add($productId, $count, $productVariableId = 0)
    {
        //if($productVariableId !== 0) {
            $link = OrderItems::findOne(['product_id' => $productId, 'product_variable_id' => $productVariableId, 'order_id' => $this->order->id]);
            if (!$link) {
                $link = new OrderItems();
            }
            $link->product_id = $productId;
            $link->product_variable_id = $productVariableId;
            $link->order_id = $this->order->id;
            $link->count += $count;
            $link->price = $link->product->price;
            return $link->save();
        //}
        //else {
        /*
            $link = OrderItems::findOne(['product_id' => $productId, 'order_id' => $this->order->id]);
            if (!$link) {
                $link = new OrderItems();
            }
            $link->product_id = $productId;
            $link->product_variable_id = $productVariableId;
            $link->order_id = $this->order->id;
            $link->count += $count;
            $link->price = $link->product->price;
            return $link->save(); */
        //}
    }
    
    private function createOrder()
    {
        $order = new Order();
        if ($order->save()) {
            $this->_order = $order;
        return true;
        }
    return false;
    }
   
    public function getOrder()
    {
        if ($this->_order == null) {
            $this->_order = Order::findOne(['id' => $this->getOrderId()]);
        }
        return $this->_order;
    }
    
    private function getOrderId()
    {
        if (!Yii::$app->session->has(self::SESSION_KEY)) {
            if ($this->createOrder()) {
                Yii::$app->session->set(self::SESSION_KEY, $this->_order->id);
            }
        }
        $test = Yii::$app->session->get(self::SESSION_KEY);
        return Yii::$app->session->get(self::SESSION_KEY);
    }

    public function delete($productId, $productVariableId = 0)
    {
        $link = OrderItems::findOne(['product_id' => $productId, 'product_variable_id' => $productVariableId, 'order_id' => $this->getOrderId()]);
            if (!$link) {
                return false;
            }
            return $link->delete();
       
    }

    public function setCount($productId, $count, $productVariableId = 0)
    {
        $link = OrderItems::findOne(['product_id' => $productId, 'product_variable_id' => $productVariableId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            return false;
        }
        $link->count = $count;
        return $link->save();
    }
    
    //Мой метод получения комплексного статуса корзины (не используется)
    public function getStatusOrder()
    {
        
        if ($this->isEmpty()) {
            //Здесь надо бы что то вернуть поинформативней, чем просто false
            return false;
        }
        
        $status = [];
        $status['productsCount'] = $this->order->productsCount;
        $status['productsAmount'] = $this->order->productsAmount;
        
        return $status;
        
    }
    
    //Получение кол-ва товаров в корзине по одной позиции товара
    public function getSingleProductCountStatus($productId, $count, $productVariableId = 0) {
        $link = OrderItems::findOne(['product_id' => $productId, 'product_variable_id' => $productVariableId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            return false;
        }
        
        return $link->countItem;
    }
    
    //Получение суммы в корзине по одному товару
    public function getSingleProductAmountStatus() {
        if ($this->isEmpty()) {
            //Здесь надо бы что то вернуть поинформативней, чем просто false
            return false;
        }
        
        return $this->order->productsAmount;
    }
    
    //Получение общего кол-ва товаров в корзине
    public function getCountStatus() {
        if ($this->isEmpty()) {
            //Здесь надо бы что то вернуть поинформативней, чем просто false
            return false;
        }
        
        return $this->order->productsCount;
    }
    
    //Получение суммы всех товаров в корзине
    public function getAmountStatus() {
        if ($this->isEmpty()) {
            //Здесь надо бы что то вернуть поинформативней, чем просто false
            return false;
        }
        
        return $this->order->productsAmount;
    }
    
    public function isEmpty()
    {
        
        if (!Yii::$app->session->has(self::SESSION_KEY)) {
            return true;
        }
        
        return $this->order->productsCount ? false : true;
    }
}