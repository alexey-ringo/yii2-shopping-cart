<?php

namespace common\models\shop;

use yii\db\ActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $address
 * @property int $status
 *
 * @property OrderItems[] $orderItems
 */
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order}}';
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id', 'status'], 'integer'],
            [['first_name', 'last_name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
        
    }
    
    
    
    //Возвращает суммарное количество всех товаров в корзине (всех товаров данного заказа)
    public function getProductsCount() {
        return  $this->getOrderItems()->sum('count');
    }
    
    //Возвращает общую стоимость корзины (общую стоимость всех товаров данного заказа)
    public function getProductsAmount() {
        $orderItems = $this->orderItems;
        $sumItem = 0;
        foreach($orderItems as $orderItem) {
            $sumItem += $orderItem->count * $orderItem->price;
        }
        return $sumItem;
    }
    
}
