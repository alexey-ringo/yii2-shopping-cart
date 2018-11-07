<?php

namespace common\models\shop;

use Yii;

/**
 * This is the model class for table "{{%attribute_value}}".
 *
 * @property int $id
 * @property int $attribute_id
 * @property string $value_str
 * @property int $value_int
 * @property string $descr
 *
 * @property Attribute $attribute0
 * @property ProductAttributeValue[] $productAttributeValues
 * @property Product[] $products
 * @property ProductVariableAttributeValue[] $productVariableAttributeValues
 */
class AttributeValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute_value}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['attribute_id', 'value_str'], 'required'],
            [['attribute_id', 'value_int'], 'integer'],
            [['descr'], 'string'],
            [['value_str'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attribute_id' => 'Attribute ID',
            'value_str' => 'Value Str',
            'value_int' => 'Value Int',
            'descr' => 'Descr',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttribute1()
    {
        return $this->hasOne(Attribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::className(), ['attribute_value_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('{{%product_attribute_value}}', ['attribute_value_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariableAttributeValues()
    {
        return $this->hasMany(ProductVariableAttributeValue::className(), ['attribute_value_id' => 'id']);
    }
    
    
    /**
     * @return \yii\db\ActiveQuery
     */
    /* 
    public function getAttributes1()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id']);
    }
    */
}
