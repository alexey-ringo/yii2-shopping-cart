<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Attribute;
use backend\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\models\Value */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="value-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_code')->dropDownList(Product::productsList()) ?>

    <?= $form->field($model, 'attribute_id')->dropDownList(Attribute::attributesList()) ?>

    <?= $form->field($model, 'value_str')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_int')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
