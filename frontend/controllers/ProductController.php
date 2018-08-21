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
        //Альтернативный способ получения id из массива get:
        //$id = Yii::$app->request->get('id');
        $product = Product::findOne($id);
        //$product = Product::find()->where(['id' => $id])->one();
        if(empty($product)) {
            throw new \yii\web\HttpException(404, 'Такого товара нет');
        }
        //Возможный вариант с жадной загрузкой:
        //$product = find($id)->with('category')->where('id' => $id)->limit(1)->one();
        
        $hits = Product::find()->where(['hit' => 1])->limit(6)->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->meta_keywords, $product->meta_description);
        $attrForProd = $product->AttributesForProduct;
        
        
        
        return $this->render('view', [
            'product' => $product,
            'attrForProd' => $attrForProd, 
            'hits' => $hits,
            ]);
    }
    
    
    public function actionViewModal($id) {
         $product = Product::findOne($id);
        //Модальному окну корзины не нужен html-шаблон
        $this->layout = false;
        return $this->render('view-modal', [
            'product' => $product,
            ]);
    }
    
    
    public function actionModal($id) {
        //$result['product'] = $product = Product::find()->where(['id' => $id])->asArray()->one();
        //$result['images'] = $product->images;
        
        $result['product'] = $product = Product::find()->where(['id' => $id])->one();
        $result['images'] = $product->imageProduct;
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
        
        return $result;
           
    }
    
}
