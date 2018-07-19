<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<div class="container">
    
    <!--флешка-->
    <?php if (Yii::$app->session->hasFlash('success')) :?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong><?php echo Yii::$app->session->getFlash('success'); ?></strong>
    </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')) :?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong><?php echo Yii::$app->session->getFlash('error'); ?></strong>
    </div>
    <?php endif; ?>
    
    <?php if(!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-stripped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Сумма</th>
                    <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($session['cart'] as $id => $item): ?>
                <tr>
                    <td>
                        <a href="<?= Url::to(['product/view', 'id' => $id]) ?>">
                            <?= Html::img("@web/eshopper/images/products/{$item['img']}", ['alt' => $item['name'], 'height' => 50]) ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?= Url::to(['product/view', 'id' => $id]) ?>">
                        <?= $item['name'] ?>
                        </a>
                    </td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><?= $item['qty'] * $item['price'] ?></td>
                    <td><span class="glyphicon glyphicon-remove text-danger del-item" 
                    data-id="<?= $id ?>" aria-hidden="true"></span></td>
                </tr>    
            <?php endforeach; ?>
                <tr>
                    <td colspan="5">Итого: </td>
                    <td><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="5">На сумму: </td>
                    <td><?= $session['cart.sum'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr/>
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($order, 'first_name') ?>
    <?= $form->field($order, 'last_name') ?>
    <?= $form->field($order, 'email') ?>
    <?= $form->field($order, 'phone') ?>
    <?= $form->field($order, 'address') ?>
    
    <?= Html::submitButton('Заказать', ['class' => 'btn btn-success']) ?>
    <?php ActiveForm::end() ?>
    <hr/>
<?php else: ?>
    <h3>Корзина пуста</h3>

<?php endif; ?>

</div>