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
                    <th><span class="gliphicon gliphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td>Картинка</td>
                    <td>Имя</td>
                    <td>Кол-во</td>
                    <td>Цена</td>
                    <td><span class="gliphicon gliphicon-remove text-danger del-item" aria-hidden="true"></span></td>
                </tr>    
            
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
