<?php
namespace frontend\controllers;


use frontend\models\Category;
use frontend\models\Product;
use Yii;

/**
 * Product controller
 */
class ProductController extends AppController {
    
    /**
     * Displays a single Product model.
     * @param integer $id (product id)
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        //Возможный вариант с жадной загрузкой:
        //$product = find($id)->with('category')->where('id' => $id)->limit(1)->one();
        
        $hits = Product::find()->where(['hit' => 1])->limit(6)->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->meta_keywords, $product->meta_description);
        
        return $this->render('view', [
            'product' => $product,
            'hits' => $hits,
            ]);
    }
    
}
