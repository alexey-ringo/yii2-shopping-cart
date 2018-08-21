<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%product_tag}}".
 *
 * @property int $product_code
 * @property int $tag_id
 *
 * @property Product $productCode
 * @property Tag $tag
 */
class ProductTag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product_tag}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_code', 'tag_id'], 'required'],
            [['product_code', 'tag_id'], 'integer'],
            [['product_code'], 'unique'],
            [['product_code', 'tag_id'], 'unique', 'targetAttribute' => ['product_code', 'tag_id']],
            [['product_code'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_code' => 'code']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_code' => 'Product Code',
            'tag_id' => 'Tag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductCode()
    {
        return $this->hasOne(Product::className(), ['code' => 'product_code']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
