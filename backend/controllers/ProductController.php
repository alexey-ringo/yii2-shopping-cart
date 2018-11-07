<?php

namespace backend\controllers;

use backend\controllers\AppController;
//use Yii;
use common\models\shop\Category;
use common\models\shop\Product;
use common\models\shop\ProductVariable;
use common\models\shop\ProductVariableAttributeValue;
use common\models\shop\ProductAttributeValue;
use common\models\shop\AttributeValue;
use common\models\shop\Attribute;
use common\models\shop\ImageProduct;

//use frontend\controllers\behaviors\AccessBehavior;

class ProductController extends AppController
{
    //Внедряем (подключаем) Поведение в даннвый Контроллер(Компонент)
    //Теперь вызов всех методов классов поведения возможен в этом контроллере через $this->
    //Возвращает массив элементов, соответствующих поведениям
    //public function behaviors() {
        
   //     return [
            //Указываем полное имя класса при помощи метода className()
            //AccessBehavior::className(),
    //        ];
        
    //}
    
    
    public function actionCreate()
    {
        /*
        $model = new Author();
        //Загрузка данных в модель
        //Условие if выполнится только если load() и save() вернут true
        //load() выполнится только в случае получания массива $_POST
        //save() выполнится только после выполнения validation(), автоматически выполняемого перед save()
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Новый автор успешно добавлен');
            return $this->redirect(['author/index']);
        }
        return $this->render('create', [
            'model' => $model, 
            ]);
            */
    }

    public function actionDelete($id) {
        /*
        $model = Author::findOne($id);
        $model->delete();
        Yii::$app->session->setFlash('success', 'Новый автор успешно удален');
        return $this->redirect(['author/index']);
        */
    }

    public function actionIndex($category) {
        
        $products = Product::find()->where(['category_id' => $category])->all();
        $currentCategory = Category::findOne($category);
        return $this->render('index', [
            'products' => $products,
            'currentCategory' => $currentCategory,
            ]);
    }
    
    //В GET передаем в action id-записи, которую нужно редактировать
    public function actionUpdate($id) {
        /*
        //findOne() - сокращенный вариант find()->one() Возврящает объект класса ActiveQuery
        //одновременно уже и с собранной для модификации запроса инф и уже выполненным запросом
        $model = Author::findOne($id);
        
        if($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Новый автор успешно отредактирован');
            return $this->redirect(['author/index']);
        }
        
        return $this->render('update', [
            'model' => $model,
        ]);
        */
    }

}
