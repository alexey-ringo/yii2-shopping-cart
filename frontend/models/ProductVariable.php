<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%product_variable}}".
 *
 * @property int $id
 * @property int $product_id
 * @property int $sku
 * @property string $name
 * @property string $price
 * @property int $status
 * @property int $qty
 *
 * @property Product $product
 * @property ProductVariableAttributeValue[] $productVariableAttributeValues
 */
class ProductVariable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_variable}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'sku', 'name'], 'required'],
            [['product_id', 'sku', 'status', 'qty'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['sku'], 'unique'],
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
            'sku' => 'Sku',
            'name' => 'Name',
            'price' => 'Price',
            'status' => 'Status',
            'qty' => 'Qty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariableAttributeValues()
    {
        return $this->hasMany(ProductVariableAttributeValue::className(), ['product_variable_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\query\ProductVariableQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\query\ProductVariableQuery(get_called_class());
    }
}
