<?php
namespace frontend\controllers;

use yii\web\Controller;

/**
 * Main controller
 */
class AppController extends Controller {
    
    protected function setMeta($title = null, $keywords = null, $description = null) {
        $this->view->title = $title;
        //Двойнык кавычки нужны для вывода во view как мин. - пустой строки, если не были переданы параметры $keywords и $description
        $this->view->registerMetaTag(['name' => 'keywords', 'content' => "$keywords"]);
        $this->view->registerMetaTag(['name' => 'description', 'content' => "$description"]);
    }
    
}