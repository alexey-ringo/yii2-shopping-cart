<?php

namespace frontend\models;

use yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $qty
 * @property string $sum
 * @property int $status
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $address
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }
    
    public function getOrderItems() {
        //Один заказ ко многим товарам
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //ограничимся только полями, вводимыми пользователем
            [['first_name', 'last_name', 'email', 'phone', 'address'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['qty'], 'integer'],
            [['sum'], 'number'],
            //явно определили булевый тип
            [['status'], 'boolean'],
            [['first_name', 'last_name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
        ];
    }
    
    //сохраняет все товары в рамках одного заказа в таблице order_items с указанием id-заказа
    //передаем корзину $session['cart'] и id-заказа $order->id
    /*
    public function saveOrderItems($items, $order_id) {
        foreach($items as $id => $item) {
            //каждый объект OrderItems - новая строка в таблице order_items
            $order_items = new OrderItems();
            $order_items->order_id = $order_id;
            $order_items->product_id = $id;
            $order_items->name = $item['name'];
            $order_items->price = $item['price'];
            $order_items->qty_item = $item['qty'];
            $order_items->sum_item = $item['qty'] * $item['price'];
            $order_items->save();
            
        }
    }
    */
}
