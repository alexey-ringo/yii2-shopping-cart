<?php use yii\helpers\Url; ?>

<li>
    <?php if(!isset($category['childs']) ): ?>
    <a href="<?=Url::to(['category/view', 'id' => $category['id']]); ?>"><?=$category['name']; ?></a>
    <?php else: ?>
    <a href="#"><?=$category['name']; ?></a>
    <?php endif ?>
    
        <?php if( isset($category['childs']) ): ?>
            <ul class="sub-menu-m">
                <?= $this->getMenuHtml($category['childs']) ?>
            </ul>
        <?php endif ?>
        <?php if(isset($category['childs']) ): ?>
        <span class="arrow-main-menu-m">
			<i class="fa fa-angle-right" aria-hidden="true"></i>
		</span>
        <?php endif ?>
</li>

