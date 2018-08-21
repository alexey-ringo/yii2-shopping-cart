<?php

namespace frontend\models;

use yii\db\ActiveRecord;
/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $img
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class Cart extends ActiveRecord {
    
    public function addToCart($product, $qty = 1) {
        if(isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }
        else {
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->imageProduct->img1,
                ];
        }
        
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
        
        return true;
    }
    
    public function recalc($id) {
        //если товара с переданным на удаление id нет в текущей корзине:
        if(!isset($_SESSION['cart'][$id])) {
            return false;
        }
        //Вычисление дельты, на которую нужно будет 
        //уменьшить итоговое кол-во и итоговую стоимость корзины
        $qtyMinus = $_SESSION['cart'][$id]['qty'];
        $sumMinus = $_SESSION['cart'][$id]['qty'] * $_SESSION['cart'][$id]['price'];
        
        //Уменьшение общего кол-ва и стоимости корзины на рассчитанное значение
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        
        //Собственно удаление элемента (товара)
        unset($_SESSION['cart'][$id]);
    }
}
