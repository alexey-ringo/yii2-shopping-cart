<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Attribute;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ValueSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Values';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="value-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Value', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'product_id',
            //'attribute_id',
            [
                'attribute' => 'attribute_id',
                'filter' => Attribute::attributesList(),
                /*
                //Анонимная функция вызывается для каждой строки
                'value' => function(backend\models\Attribute $attribute) {
                    return $attribute->products ? $attribute->products->name : 'Нет';
                }
                */
                'value' => 'productAttribute.name',
            ],
            'value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
