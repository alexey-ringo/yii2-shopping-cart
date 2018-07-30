<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\Product]].
 *
 * @see \backend\models\Product
 */
class ProductQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \backend\models\Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
