<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%value}}".
 *
 * @property int $id
 * @property int $product_code
 * @property int $attribute_id
 * @property string $value_str
 * @property int $value_int
 *
 * @property Attribute $attribute0
 * @property Product $productCode
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
            [['product_code', 'attribute_id', 'value_str'], 'required'],
            [['product_code', 'attribute_id', 'value_int'], 'integer'],
            [['value_str'], 'string', 'max' => 255],
            [['product_code'], 'unique'],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
            [['product_code'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_code' => 'code']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_code' => 'Product Code',
            'attribute_id' => 'Attribute ID',
            'value_str' => 'Value Str',
            'value_int' => 'Value Int',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute0()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCode()
    {
        return $this->hasOne(Product::className(), ['code' => 'product_code']);
    }
}
