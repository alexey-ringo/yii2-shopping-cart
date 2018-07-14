<?php use yii\helpers\Url; ?>

<li>
    <a href="<?=Url::to(['category/view', 'id' => $category['id']]); ?>"><?=$category['name']; ?></a>
        <?php if( isset($category['childs']) ): ?>
            <ul class="sub-menu">
                <?= $this->getMenuHtml($category['childs']) ?>
            </ul>
        <?php endif ?>
</li>

