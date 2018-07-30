<?php

namespace frontend\models;

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
 * @property int $active
 *
 * @property Category $category
 * @property Value[] $values
 * @property Attribute[] $attributes0
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
            [['category_id', 'code', 'hit', 'new', 'active'], 'integer'],
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
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    public function getImages() {
        return $this->hasOne(ImageProduct::className(), ['product_code' => 'code']);
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
    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('{{%value}}', ['product_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\query\ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\models\query\ProductQuery(get_called_class());
    }
}
