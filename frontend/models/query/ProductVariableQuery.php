<?php

namespace frontend\models\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\ProductVariable]].
 *
 * @see \frontend\models\ProductVariable
 */
class ProductVariableQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\ProductVariable[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\ProductVariable|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
