<?php

namespace common\models\shop;

use Yii;
use frontend\models\Product;
use frontend\models\ProductVariable;


/**
 * This is the model class for table "{{%order_items}}".
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $product_variable_id
 * @property int $count
 * @property string $price
 *
 * @property Order $order
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'product_variable_id'/*, 'count', 'price'*/], 'required'],
            //[['order_id', 'product_id', 'count', 'price'], 'safe'],
            [['order_id', 'product_id', 'product_variable_id', 'count'], 'integer'],
            [['price'], 'number'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'product_variable_id' => 'Product Variable ID',
            'count' => 'Count',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
        
    }
    
    public function getProductVariable()
    {
        return ProductVariable::findOne($this->product_variable_id);
        
    }
    
    //Возвращает количество заказанных товаров по данной позиции
    public function getCountItem() {
        return $this->count;
    }
    
    //Возвращает общую стоимость заказанных товаров по данной позиции
    public function getAmountItem() {
        return $this->count * $this->price;
    }
}
