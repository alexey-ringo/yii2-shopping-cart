<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%value}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $attribute_id
 * @property string $value_str
 * @property int $value_int
 *
 * @property AttrOrder[] $attrOrders
 * @property OrderItems[] $orders
 * @property Attribute $attribute0
 * @property Product $product
 */
class Value extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'attribute_id', 'value_str'], 'required'],
            [['product_id', 'attribute_id', 'value_int'], 'integer'],
            [['value_str'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'attribute_id' => 'Attribute ID',
            'value_str' => 'Value Str',
            'value_int' => 'Value Int',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrOrders()
    {
        return $this->hasMany(AttrOrder::className(), ['attr_val_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(OrderItems::className(), ['id' => 'order_id'])->viaTable('{{%attr_order}}', ['attr_val_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttribute()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
