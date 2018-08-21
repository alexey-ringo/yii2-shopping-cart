<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%product}}".
 *
 * @property int $id
 * @property int $category_id
 * @property int $code
 * @property string $name
 * @property string $content
 * @property string $price
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int $hit
 * @property int $new
 * @property int $status
 *
 * @property ImageProduct $imageProduct
 * @property OrderItems[] $orderItems
 * @property Category $category
 * @property ProductTag[] $productTags
 * @property Tag[] $tags
 * @property Value[] $values
 * @property Attribute[] $productAttributes
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
            [['category_id', 'code', 'hit', 'new', 'status'], 'integer'],
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
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['product_id' => 'id']);
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
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%product_tag}}', ['product_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['product_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    //Получить для продукта массив со всеми установленными для него атрибутами
    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('{{%value}}', ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\ProductQuery(get_called_class());
    }
    
    //Массив всех продуктов для выпадающего списка, где ключ - id товара п значение - имя товара
    public static function productsList() {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
