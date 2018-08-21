<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'code',
            'name',
            'content:ntext',
            'price',
            'meta_title',
            'meta_keywords',
            'meta_description',
            'hit',
            'new',
            'active',
        ],
    ]) ?>
    
    
    <?= GridView::widget([
        //При создании нового экземпляра датапровайдера передаем в параметры объект ActiveQuery (обращаемся к полному имени метода getValues() )
        'dataProvider' => new ActiveDataProvider(['query' => $model->getValues()]),
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'product_id',
            //'attribute_id',
            [
                'attribute' => 'attribute_id',
                //Анонимная функция вызывается для каждой строки
                'value' => function(backend\models\Attribute $attribute) {
                    return $attribute->products ? $attribute->products->name : 'Нет';
                } 
                
            ],
            'value',

            ['class' => 'yii\grid\ActionColumn'],
            'controller' => 'value',
        ],
    ]); ?>

</div>
