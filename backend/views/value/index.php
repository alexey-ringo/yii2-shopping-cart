<?php

use yii\helpers\Html;
use yii\grid\GridView;

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

            'id',
            //'product_id',
            //расширенный формат отображения поля product_id
            [
                'attribute' => 'product_id',
                //Выпадающий список поиска продуктов по категории
                //'filter' => Category::allCategoriesList(),
                //Анонимная функция вызывается для каждой строки
                'value' => function(backend\models\Value $value) {
                    return $value->product ? $value->product->name : 'Товар отсутствует';
                }
            ],
            //'attribute_id',
            //расширенный формат отображения поля attribute_id
            [
                'attribute' => 'attribute_id',
                //Выпадающий список поиска продуктов по категории
                //'filter' => Category::allCategoriesList(),
                //Анонимная функция вызывается для каждой строки
                'value' => function(backend\models\Value $value) {
                    return $value->productAttribute ? $value->productAttribute->name : 'Атрибуты отсутствуют';
                }
            ],
            'value_str',
            'value_int',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
