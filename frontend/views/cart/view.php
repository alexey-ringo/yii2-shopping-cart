<?php
/* @var $this yii\web\View */
/* @var $productsInOrder frontend\controllers\ShopController */
/* @var $order frontend\controllers\ShopController */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>

<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>



	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				
<?php if(!empty($productsInOrder)): ?>
				
				<div class="col-lg-12 col-xl-12 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						


						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Товар</th>
									<th class="column-2"></th>
									<th class="column-3">Цена</th>
									<th class="column-4">Количество</th>
									<th class="column-5">Стоимость</th>
									<th class="column-6">Удалить</th>
								</tr>
								
<?php foreach($productsInOrder as $productInOrder): ?>

								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<a href="<?= Url::to(['product/view', 'id' => $productInOrder->product->id]) ?>">
                            					<?= Html::img("@web/custom_img/default/{$productInOrder->product->imageProduct->img1}", ['alt' => $productInOrder->product->name, 'height' => 50]) ?>
                        					</a>
										</div>
									</td>
									<td class="column-2">
										<a href="<?= Url::to(['product/view', 'id' => $productInOrder->product_id]) ?>">
											<?= $productInOrder->product->name ?>
											<?php if($productInOrder->product_variable_id !== 0) : ?>
												<br><br>
												<?= $productInOrder->productVariable->name ?>
											<?php endif; ?>
                        				</a>
									</td>
									<td class="column-3"><?= $productInOrder->price ?> Руб.</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0">
											<div class="btn-num-product-down-incart cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1" value="<?= $productInOrder->countItem ?>">

											<div class="btn-num-product-up-incart cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5"><?= $productInOrder->amountItem ?> Руб.</td>
									<td class="column-6">
										
										<form method="post">
											<input type="hidden" name="product_id" id="product_id" value="<?= $productInOrder->product_id ?>" />
											<input type="hidden" name="product_variable_id" id="product_variable_id" value="<?= $productInOrder->product_variable_id ?>" />
    										
    										<input id="form-token" type="hidden" name="<?=Yii::$app->request->csrfParam?>"
        									value="<?=Yii::$app->request->csrfToken?>"/>
    
    										<input type="submit" class="btn btn-danger" value="Удалить" />
										</form>
										
										
										
									</td>
								</tr>

 <?php endforeach; ?>
 
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>
<!--
							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Изменить корзину
							</div>
-->
						</div>
						
						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">

							<div class="flex-w flex-m m-r-20 m-tb-5">
								<span class="mtext-110 cl2">
									<?= $order->productsAmount ?> Руб.
								</span>
							
<!--
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
-->
								
							</div>

							
							<a href="<?= Url::to(['order/create']) ?>" class="flex-c-m stext-101 cl0 size-119 bg3 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Приступить к оформлению заказа
							</a>
							

						
						</div>
						
						
					</div>
				</div>
<!--
				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									$<?= $order->productsAmount ?>
								</span>
							</div>
						</div>

						<div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										
								</div>
							</div>
						</div>

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									$79.65
								</span>
							</div>
						</div>

						<a href="<?= Url::to(['order/create']) ?>" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Приступить к оформлению заказа
						</a>
					</div>
				</div>
-->				
<?php else: ?>

    <h3>Корзина пуста</h3>

<?php endif; ?>
				
			</div>
		</div>
	</div>