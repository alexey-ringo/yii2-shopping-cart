<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property int $id
 * @property string $name
 * @property string $descr
 * @property string $type
 * @property string $variants
 *
 * @property AttributeValue[] $attributeValues
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
            [['descr'], 'string'],
            [['name', 'type', 'variants'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'descr' => 'Descr',
            'type' => 'Type',
            'variants' => 'Variants',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['attribute_id' => 'id']);
    }
    
    /*
    public static function getAttributesForProduct($product_id) {
        
        return  self::find()->joinWith(['attributeValues.productVariableAttributeValues.productVariable.product'])->where(['product.id' => $product_id])->asArray()->all();
    }
    */
    
    //Получаем все атрибуты и их значения для основного товара Product по его id и конвертим во вложенный массив
    //Запрашивается из ProductController@actionView
    public static function getAttributesForProduct($id) {
        
        return  self::find()->joinWith(['attributeValues' => function($query) use($id) {
                                            $query->joinWith(['productVariableAttributeValues' => function($query) use($id) {
                                                $query->joinWith(['productVariable' => function($query) use($id) {
                                                    $query->joinWith(['product' => function($query) use($id) {
                                                    
                                                    
                                                        $query->where(['product.id' => $id]); 
                                                        
                                                        }]);
                                                    }]);                   
                                                }]);
                                            }])->asArray()->all();
    }
    
    
    
   
    
}
