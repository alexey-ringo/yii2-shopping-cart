<?php
/* @var $this yii\web\View */
/* @var $session yii\web\Session */

use yii\helpers\Html;
?>

<?php if(!empty($session['cart'])): ?>

<?php foreach($session['cart'] as $id => $item): ?>

				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<?= Html::img("@web/custom_img/default/{$item['img']}", ['alt' => $item['name'], 'height' => 50]) ?>
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								<?= $item['name'] ?>
							</a>

							<span class="header-cart-item-info">
								<?= $item['qty'] ?> x $<?= $item['price'] ?>
							</span>
						</div>
					</li>
				</ul>
				
<?php endforeach; ?>
				
				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: <?= $session['cart.qty'] ?>
					</div>
					
					<div class="header-cart-total w-full p-tb-40">
						Total: $<?= $session['cart.sum'] ?>
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
				
<?php else: ?>

    <h3>Корзина пуста</h3>

<?php endif; ?>
