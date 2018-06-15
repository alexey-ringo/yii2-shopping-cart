<?php
namespace frontend\controllers;


use frontend\models\Category;
use frontend\models\Product;
use Yii;
/**
 * Category controller
 */
class CategoryController extends AppController {
    
    public function actionIndex() {
        $hits = Product::find()->where(['hit' => 1])->limit(6)->all();
        //debug($hits->price);
        return $this->render('index', [
            'hits' => $hits
            ]);
    }
    
}