<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $code
 * @property string $name
 * @property int $variable
 * @property string $content
 * @property string $price
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int $hit
 * @property int $new
 * @property int $status
 *
 * @property ImageProduct[] $imageProducts
 * @property Category $category
 * @property ProductAttributeValue[] $productAttributeValues
 * @property AttributeValue[] $attributeValues
 * @property ProductVariable[] $productVariables
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'code', 'name'], 'required'],
            [['category_id', 'code', 'variable', 'hit', 'new', 'status'], 'integer'],
            [['content'], 'string'],
            [['price'], 'number'],
            [['name', 'meta_title', 'meta_keywords', 'meta_description'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'code' => 'Code',
            'name' => 'Name',
            'variable' => 'Variable',
            'content' => 'Content',
            'price' => 'Price',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'hit' => 'Hit',
            'new' => 'New',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageProduct()
    {
        return $this->hasOne(ImageProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributeValues()
    {
        return $this->hasMany(ProductAttributeValue::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributeValues()
    {
        return $this->hasMany(AttributeValue::className(), ['id' => 'attribute_value_id'])->viaTable('{{%product_attribute_value}}', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductVariables()
    {
        return $this->hasMany(ProductVariable::className(), ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\query\ProductQuery(get_called_class());
    }

    /*
    public function getAttributesForProduct($id) {
        $attrForProd = Product::find()->with('attributeValues', 'productAttribute')->where('id' => $id)->one();
        return $attrForProd;
    }
    */
    public function getAttributeValuesForProduct() {
        return Product::find()->with('attributeValues')->where(['id' => $this->id])->asArray()->one();
       
    }
    
    //Получение у Пробукта всех его атрибутов и их значений 
    public function getAttributesForProduct() {
        $attrValArray = Product::find()->with('attributeValues.attribute1')->where(['id' => $this->id])->asArray()->one();
       
        return Yii::$app->arrayProdHelper->getAttrValArray($attrValArray);
    }
    
}
