<?php
namespace frontend\controllers;


use frontend\models\Category;
use frontend\models\Product;
use frontend\models\ProductVariable;
use frontend\models\Attribute;
use Yii;

//Лаба
use yii\helpers\ArrayHelper;

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
        
        //$hits = Product::find()->where(['hit' => 1])->limit(6)->all();
        $this->setMeta('E-SHOPPER | ' . $product->name, $product->meta_keywords, $product->meta_description);
        //Получаем для данного товара $product все его атрибуты и их значения (конвертим во вложенный массив)
        $attributes = Attribute::getAttributesForProduct($id);
        
        /*------------------------------------------ ЛАБА--------------------------------------- */
        
        
        
        
        $test = ProductVariable::find()
                            ->joinWith(['product' => function ($query) use($id) {
                                $query->where(['product.id' => $id]);
                                
                            },
                            
                                                                
                                        'productVariableAttributeValues' => function($query) {
                                            $query->joinWith(['attributeValue' => function($query) {
                                                    $query->where(['attribute_value.id' => 4]);
                                                    
                                                    $query->joinWith(['attribute1' => function($query) {
                                                        $query->where(['attribute.id' => 2]);
                                                        
                                                    }]);
                                                    
                                                }]);
            
                                            }
                                            
                                            
                                 
                                            
                                            
                                            ])->one();
                                           
        
        
        
        
            
        
        /*    
        $test = Product::find()->joinWith(['productVariable.productVariableAttributeValues.attributeValue.attribute1'])->where(['product.id' => $product->id])
            ->onCondition(['attribute_value.value_str' => 'Красный'])->andonCondition(['attribute_value.value_str' => 'S'])
            ->andOnCondition(['attribute.name' => 'Цвет'])->andOnCondition(['attribute.name' => 'Размер'])->all();
        */
         
        //$test = self::find()->with('productVariable.productVariableAttributeValues.attributeValue.attribute1')->where(['id' => $this->id])->all();
        /*
        $test = Product::find()->joinWith(['productVariable.productVariableAttributeValues.attributeValue.attribute1'])->where(['product.id' => $product->id])
            ->andWhere(['attribute_value.value_str' => 'Красный'])->andWhere(['attribute_value.value_str' => 'S'])
            ->andWhere(['attribute.name' => 'Цвет'])->andWhere(['attribute.name' => 'Размер'])->all();
        */    
        /*$test = self::find()->joinWith(['productVariable.productVariableAttributeValues.attributeValue.' => function($query) {
                                                    $query->joinWith('attribute1' => function);
                                                }])->where(['product.id' => $this->id])->andWhere(['product_variable.product_id' => $this->id])->one();
                                                */    
        /*----------------------------*/
        /*
        
        */
        /*---------------------------*/
        
        /*
        $test = ProductVariable::find()->joinWith(['product' => function($q) {$q->where(['product.id' => 1]);},
            
            
            
            
            'productVariableAttributeValues' => function($q) {
                                                $q->joinWith(['attributeValue' => function($q) {
                                                    $q->andWhere(['attribute_value.id' => 3])->andWhere(['attribute_value.id' => 6]);
                                                    //$q->where(['attribute_value.id' => 3]);
                                                    $q->joinWith(['attribute1' => function($q) {
                                                        //$q->where(['attribute.id' => 1]);
                                                        $q->andWhere(['attribute.id' => 1])->andWhere(['attribute.id' => 2]);
                                                        return $q;
                                                            
                                                            
                                                        
                                                        
                                                    }], true, 'RIGHT JOIN');
                                                    
                                                }], true, 'RIGHT JOIN');
            
                                            }
                                            
                                            
                                 
                                            
                                            
                                            ], true, 'RIGHT JOIN')->asArray()->all();
        
        */
        
        /*--------------------------*/
       /*
       $test = ProductVariable::find()->joinWith(['product'])->where(['product.id' => 1])
            ->joinWith(['productVariableAttributeValues.attributeValue.attribute1'], true, 'FULL OUTER JOIN')
            ->andWhere(['attribute.id' => 1])->andWhere(['attribute.id' => 2])->andWhere(['attribute_value.id' => 3])->andWhere(['attribute_value.id' => 6])
            ->asArray()->all();
       */
        /*--------------------------*/
        
        /*
        $test = ProductVariable::find()->joinWith(['product' => function($q) {$q->where(['product.id' => 1]);},
            
            
            
            
            'productVariableAttributeValues pAVFirst' => function($q) {
                                                $q->joinWith(['attributeValue aVFirst' => function($q) {
                                                    $q->where(['aVFirst.id' => 3]);
                                                    $q->joinWith(['attribute1 a1First' => function($q) {
                                                        $q->where(['a1First.id' => 1]); 
                                                            
                                                            
                                                        
                                                        
                                                    }]);
                                                    
                                                }]);
            
                                            },
                                            
                                            
            'productVariableAttributeValues pAV' => function($q) {
                                                $q->joinWith(['attributeValue aV' => function($q) {
                                                    $q->andWhere(['aV.id' => 6]);
                                                    $q->joinWith(['attribute1 a1' => function($q) {
                                                        $q->andWhere(['a1.id' => 2]); 
                                                            
                                                            
                                                        
                                                        
                                                    }]);
                                                    
                                                }]);
            
                                            }                                
                                            
                                            
                                            ], true, 'INNER JOIN')->asArray()->all();
        */
        
        /*--------joinWith() цепочкой---------------------*/
        /*
        $test = ProductVariable::find()->joinWith(['product' => function($q) {$q->where(['product.id' => 1]);}])
            
            
            
            
            ->joinWith(['productVariableAttributeValues' => function($q) {
                                                $q->joinWith(['attributeValue' => function($q) {
                                                    //$q->where(['attribute_value.id' => 3]);
                                                    $q->joinWith(['attribute1' => function($q) {
                                                        //$q->where(['attribute.id' => 1]); 
                                                            
                                                            
                                                        
                                                        
                                                    }]);
                                                    
                                                }]);
            
                                            }])
                                            
                                            
            ->joinWith(['productVariableAttributeValues' => function($q) {
                                                $q->joinWith(['attributeValue' => function($q) {
                                                    //$q->andWhere(['attribute_value.id' => 6]);
                                                    $q->joinWith(['attribute1' => function($q) {
                                                        //$q->andWhere(['attribute.id' => 2]); 
                                                            
                                                            
                                                        
                                                        
                                                    }]);
                                                    
                                                }]);
            
                                            }                                
                                            
                                            
                                            ])->asArray()->all();
        
        */
        /*------------------------------------------------ ЛАБА----------------------------------------- */
        
        
        return $this->render('view', [
            'product' => $product,
            'attributes' => $attributes, 
            //'hits' => $hits,
            /* -------------ЛАБА-------------------------- */
            //'test' => $test,
            /*------------- ЛАБА-------------------------- */
            ]);
    }
    
   
    
    public function actionModal() {
        //$result['product'] = $product = Product::find()->where(['id' => $id])->asArray()->one();
        //$result['images'] = $product->images;
        
        //Если запрос пришел не AJAX и не POST-методом, 
        //то возвращаем пользователя на страницу, с которой он пришел
        if(!Yii::$app->request->isPost && !Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        $id = Yii::$app->request->post('id');
        $id = intval($id);
        $result['product'] = $product = Product::find()->where(['id' => $id])->one();
        if(empty($product)) {
            throw new \yii\web\HttpException(404, 'Такого товара нет');
        }
        $result['product'] = $product = Product::find()->where(['id' => $id])->one();
        $result['images'] = $product->imageProduct;
        $result['attributes'] = $attributes = Attribute::getAttributesForProduct($id);
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
        
        return $result;
           
    }
    
}
