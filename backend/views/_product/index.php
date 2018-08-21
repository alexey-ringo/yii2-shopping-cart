<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'category_id',
            //расширенный формат отображения полей виджета
            [
                'attribute' => 'category_id',
                //Выпадающий список поиска продуктов по категории
                'filter' => Category::allCategoriesList(),
                //Анонимная функция вызывается для каждой строки
                'value' => function(backend\models\Product $product) {
                    return $product->category ? $product->category->name : 'Корневая';
                }
            ],
            'code',
            'name',
            'content:ntext',
            //'price',
            //'meta_title',
            //'meta_keywords',
            //'meta_description',
            //'hit',
            //'new',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
