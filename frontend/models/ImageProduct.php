<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "image_product".
 *
 * @property int $id
 * @property int $product_code
 * @property string $img1
 * @property string $img2
 * @property string $img3
 * @property string $img4
 * @property string $img5
 * @property string $img6
 */
class ImageProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_code'], 'required'],
            [['product_code'], 'integer'],
            [['img1', 'img2', 'img3', 'img4', 'img5', 'img6'], 'string', 'max' => 255],
            [['product_code'], 'unique'],
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
            'img1' => 'Img1',
            'img2' => 'Img2',
            'img3' => 'Img3',
            'img4' => 'Img4',
            'img5' => 'Img5',
            'img6' => 'Img6',
        ];
    }
    
    public function getProduct() {
        return $this->hasOne(Product::className(), ['code' => 'product_code']);
    }
}
