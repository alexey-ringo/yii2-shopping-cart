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

    public function setCount($productId, $count)
    {
        $link = OrderItems::findOne(['product_id' => $productId, 'product_variable_id' => $productVariableId, 'order_id' => $this->getOrderId()]);
        if (!$link) {
            return false;
        }
        $link->count = $count;
        return $link->save();
    }
    
    //Мой метод статуса корзины
    public function getStatusOrder()
    {
        
        if ($this->isEmpty()) {
            //Здесь надо бы что то вернуть поинформативней, чевм просто false
            return false;
        }
        
        $status = [];
        $status['productsCount'] = $this->order->productsCount;
        $status['productsAmount'] = $this->order->productsAmount;
        
        return $status;
        
    }
    
    //Исходный код метода, возвращяющего статус корзины - не используется
    public function getStatusCart()
    {
        
        if ($this->isEmpty()) {
            return Yii::t('app', 'В корзине пусто');
        }
        
        
        return Yii::t('app', 'В корзине {productsCount, number} {productsCount, plural, one{товар} few{товара} many{товаров} other{товара}} на сумму {amount} руб.', [
            'productsCount' => $this->order->productsCount,
            'amount' => $this->order->amount
        ]);
        
    }

    public function isEmpty()
    {
        
        if (!Yii::$app->session->has(self::SESSION_KEY)) {
            return true;
        }
        
        return $this->order->productsCount ? false : true;
    }
}