<?php
namespace frontend\controllers;


use frontend\models\Category;
use frontend\models\Product;
use Yii;
use yii\data\Pagination;
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
        //Пример жадной загрузки:
        //$products = Product::find()->where(['category_id' => $id])->all();
        //Получаем объект запроса ActiveQuery, без выполнения самого запроса - нужно просто подсчитать кол-во записей
        //Ленивая загрузка:
        $query = Product::find()->where(['category_id' => $id]);
        //Создаем объект класса Pagination и передаем ему общее кол-во записей (в полученном запросе)
        //и кол-во записей, которые должны отображаться на одной стр. - pageSize
        //forcePageParam и pageSizeParam - для красоты url (убрать показ get-параметров пагинации)
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        //Выполняем сам запрос и передаем в него два параметра: offset - с какой записи начинаит выборку и limit - сколько таких записей взять
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        $currentCategory = Category::findOne($id);
        $this->setMeta('E-SHOPPER | ' . $currentCategory->name, $currentCategory->meta_keywords, $currentCategory->meta_description);
        
        return $this->render('view', [
            'products' => $products,
            'currentCategory' => $currentCategory,
            'pages' => $pages
            ]);
    }
}