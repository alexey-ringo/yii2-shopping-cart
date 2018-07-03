<?php
/* @var $this yii\web\View */
/* @var $products frontend\models\Product */
/* @var $session frontend\models\Category */
/* @var $pages yii\data\Pagination */
?>

<?php if(!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-stripped">
            <thead>
                <tr>
                    <th>Фото</th>
                    <th>Наименование</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <td><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></td>
                </tr>
            </thead>
            <tbody>
            <?php foreach($session['cart'] as $id => $item): ?>
                <tr>
                    <td><?= $item['img'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td><?= $item['price'] ?></td>
                    <td><span class="glyphicon glyphicon-remove text-danger del-item" 
                    data-id="<?= $id ?>" aria-hidden="true"></span></td>
                </tr>    
            <?php endforeach; ?>
                <tr>
                    <td colspan="4">Итого: </td>
                    <td><?= $session['cart.qty'] ?></td>
                </tr>
                <tr>
                    <td colspan="4">На сумму: </td>
                    <td><?= $session['cart.sum'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <h3>Корзина пуста</h3>

<?php endif; ?>

