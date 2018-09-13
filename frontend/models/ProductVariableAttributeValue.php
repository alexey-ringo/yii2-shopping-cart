<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%product_variable_attribute_value}}".
 *
 * @property int $id
 * @property int $product_variable_id
 * @property int $attribute_value_id
 *
 * @property AttributeValue $attributeValue
 * @property ProductVariable $productVariable
 */
class ProductVariableAttributeValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_variable_attribute_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_variable_id', 'attribute_value_id'], 'required'],
            [['product_variable_id', 'attribute_value_id'], 'integer'],
            [['attribute_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttributeValue::className(), 'targetAttribute' => ['attribute_value_id' => 'id']],
            [['product_variable_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductVariable::className(), 'targetAttribute' => ['product_variable_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_variable_id' => 'Product Variable ID',
            'attribute_value_id' => 'Attribute Value ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValue()
    {
        return $this->hasOne(AttributeValue::className(), ['id' => 'attribute_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariable()
    {
        return $this->hasOne(ProductVariable::className(), ['id' => 'product_variable_id']);
    }
}
