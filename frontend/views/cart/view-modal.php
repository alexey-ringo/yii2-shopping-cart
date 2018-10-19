<?php
/* @var $this yii\web\View */
/* @var $productsInOrder frontend\controllers\ShopController */
/* @var $order frontend\controllers\ShopController */

use yii\helpers\Html;
?>

<?php if(!empty($productsInOrder)): ?>

<?php foreach($productsInOrder as $productInOrder): ?>

				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<?= Html::img("@web/custom_img/default/{$productInOrder->product->imageProduct->img1}", ['alt' => $productInOrder->product->name, 'height' => 50]) ?>
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?= $productInOrder->product->name ?>
							</a>

							<span class="header-cart-item-info">
								<?= $productInOrder->countItem ?> x <?= $productInOrder->price ?> Руб.
							</span>
						</div>
					</li>
				</ul>
				
<?php endforeach; ?>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Количество: <?= $order->productsCount ?>
					</div>
					
					<div class="header-cart-total w-full p-tb-40">
						Сумма заказа: <?=$order->productsAmount ?> Руб.
					</div>

					
				</div>
				
<?php else: ?>

    <h3>Корзина пуста</h3>

<?php endif; ?>
