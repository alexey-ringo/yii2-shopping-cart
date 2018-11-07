<?php
/* @var $this yii\web\View */
/* @var $authorsList frontend\models\Author */
use yii\helpers\Url;
?>
<h1>Товары</h1>
<br>
<br>
<h2><?= $currentCategory->name ?></h2>

<a href="<?php echo Url::to(['product/create']); ?>" class="btn btn-primary">Добавить новый товар</a>

<br><br>

<table class="table table-condensed">
    <tr>
        <th>code</th>
        <th>name</th>
        <th>variable</th>
        <th>price</th>
        <th>status</th>
        <th>Изменить данные</th>
        <th>Удалить</th>
    </tr>
<?php foreach($products as $product): ?>
    <tr>
        <td><?php echo $product->code; ?></td>
        <td><?php echo $product->name; ?></td>
        <td><?php echo $product->variable; ?></td>
        <td><?php echo $product->price; ?></td>
        <td><?php echo $product->status; ?></td>
        <td><a href="<?php echo Url::to(['product/update', 'id' => $product->id]); ?>">Редактировать</a></td>
        <td><a href="<?php echo Url::to(['product/delete', 'id' => $product->id]); ?>">Удалить</a></td>
    </tr>
<?php endforeach; ?>
</table>