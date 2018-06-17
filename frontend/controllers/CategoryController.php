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
        $this->setMeta('E-SHOPPER');
        return $this->render('index', [
            'hits' => $hits
            ]);
    }
    
    public function actionView($id) {
        $id = Yii::$app->request->get('id');
        $products = Product::find()->where(['category_id' => $id])->all();
        $currentCategory = Category::findOne($id);
        $this->setMeta('E-SHOPPER | ' . $currentCategory->name, $currentCategory->meta_keywords, $currentCategory->meta_description);
        return $this->render('view', [
            'products' => $products,
            'currentCategory' => $currentCategory
            ]);
    }
}