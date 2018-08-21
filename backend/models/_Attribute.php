<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $variants
 *
 * @property Value[] $values
 */
class Attribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%attribute}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'type', 'variants'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'variants' => 'Variants',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    //Получить массив всех значений данного атрибута
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['attribute_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    //Получить весь массив продуктов, имеющих данный атрибут
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['code' => 'product_code'])->viaTable('{{%value}}', ['attribute_id' => 'id']);
    }
    
    public static function attributesList() {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
