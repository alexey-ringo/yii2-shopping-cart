<?php
namespace frontend\controllers;

//use frontend\Controller;
use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use frontend\models\Product;
use frontend\models\ProductVariable;


class CartController extends AppController
{
    
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add-in-cart' => ['post'],
                    'set-count' => ['post'],
                    'delete-from-cart' => ['post'],
                ],
            ],
        ]);
    }
    

    public function actionAddInCartGet()
    {
        /*
        $postData = Yii::$app->request->post();
        return json_encode([
            'success' => Yii::$app->ecart->add($postData['product_id'], $postData['count']),
            'cartStatus' => Yii::$app->ecart->status
        ]);
        */
        //id добавляемого в карту товара
        $id = Yii::$app->request->get('id');
        //приводим пришедшее значение о кол-ве к числу
        $qty = (int)Yii::$app->request->get('qty');
        //если пришло false - устанавливаем 1, иначе реальное пришедшее значение qty
        $qty = !$qty ? 1 : $qty;
        
        if (Yii::$app->ecart->add($id, $qty)) {
        
            //Если запрос пришел не AJAX-методом, 
            //то возвращаем пользователя на страницу, с которой он пришел
            if(!Yii::$app->request->isAjax) {
                return $this->redirect(Yii::$app->request->referrer);
            }
            return true;
        }
        
        return false;
        
    }
    
    //Добавление в корзину простого (невариативного) товара
    public function actionAddInCartSimple()
    {
        //Если запрос пришел не AJAX и не POST-методом, 
        //то возвращаем пользователя на страницу, с которой он пришел
        if(!Yii::$app->request->isPost && !Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        $postData = Yii::$app->request->post();
        
        return json_encode([
            'success' => Yii::$app->ecart->add(intval($postData['product_id']), intval($postData['count'])),
            'productsCount' => Yii::$app->ecart->countStatus
        ]);
        
    }
    
    //Добавление в корзину вариативного товара
    public function actionAddInCartVariable() {
        
        //Если запрос пришел не AJAX и не POST-методом, 
        //то возвращаем пользователя на страницу, с которой он пришел
        if(!Yii::$app->request->isPost && !Yii::$app->request->isAjax) {
            return $this->redirect(Yii::$app->request->referrer);
        }
        
        $postData = Yii::$app->request->post();
        $productId = intval($postData['product_id']);
        $product = Product::findOne($productId);
        if(empty($product)) {
            return false;
        }
        $count = intval($postData['count']);
        $count = !$count ? 1 : $count;
        $jsonAttrValues = json_decode($postData['json_attr_value'], true) ?: [];
        
        
        $attrValues = ArrayHelper::getColumn($jsonAttrValues, 'currentVal');
        $attrValues = ArrayHelper::index($jsonAttrValues, 'currentAttr');
        
        $productVariable = ProductVariable::getProductVariableByAttrVal($productId, $attrValues);
        
        return json_encode([
            'success' => Yii::$app->ecart->add($productId, $count, $productVariable->id),
            'productsCount' => Yii::$app->ecart->countStatus
        ]);
        
    }
    
    //Все изменения кол-ва товаров делаются в actionCart() - данный метод отдыхает
    public function actionSetCount()
    {
        $postData = Yii::$app->request->post();
        $statusOrder = Yii::$app->ecart->statusOrder;
        return json_encode([
            'success' => Yii::$app->ecart->setCount($postData['product_id'], $postData['count']),
            'cartStatus' => $statusOrder['productsCount']
        ]);
    }
    
    //Все удаление делается в actionCart() - данный метод отдыхает
    public function actionDeleteFromCart()
    {
        $postData = Yii::$app->request->post();
        $statusOrder = Yii::$app->ecart->statusOrder;
        return json_encode([
            'success' => Yii::$app->ecart->delete($postData['product_id']),
            'cartStatus' => $statusOrder['productsCount']
        ]);
    }
    
    //Show modal Cart
    public function actionShowModalCart() {
        $this->layout = false;
        $order = Yii::$app->ecart->order;
        $productsInOrder = $order->orderItems;
        
        return $this->render('view-modal', [
            'order' => $order,
            'productsInOrder' => $productsInOrder,
            ]);
        
    }
    
    //Show html Cart, setCount and Delete
    public function actionCart() {
        if($postData = Yii::$app->request->post()) {
            
            //Изменение кол-ва товаров
            if(Yii::$app->request->isAjax) {
                
                return json_encode([
                    'success' => Yii::$app->ecart->setCount(intval($postData['productId']), intval($postData['count']), intval($postData['productVarId'])),
                    'productCount' => Yii::$app->ecart->getSingleCountStatus(intval($postData['productId']), intval($postData['count']), intval($postData['productVarId']))
                ]);
            }
            
            //Удаление в заказе позиции с типом товара
            if(Yii::$app->ecart->delete($postData['product_id'], $postData['product_variable_id'])) {
                $order = Yii::$app->ecart->order;
                $productsInOrder = $order->orderItems;
        
                return $this->render('view', [
                    'order' => $order,
                    'productsInOrder' => $productsInOrder,
                ]);
            }
        
        }
        
        $order = Yii::$app->ecart->order;
        $productsInOrder = $order->orderItems;
        
        return $this->render('view', [
            'order' => $order,
            'productsInOrder' => $productsInOrder,
            ]);
    }
    
    
}