<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'parent_id',
            //расширенный формат отображения полей виджета
            [
                'attribute' => 'parent_id',
                //Выпадающий список поиска категорий по родительской категории
                'filter' => Category::allCategoriesList(),
                //Анонимная функция вызывается для каждой строки
                'value' => function(backend\models\Category $category) {
                    return $category->parent ? $category->parent->name : 'Корневая';
                }
            ],
            'name',
            'description:ntext',
            'price',
            //'img',
            //'meta_title',
            //'meta_keywords',
            //'meta_description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
