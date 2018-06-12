<?php

namespace app\components;

use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget {
    //Переменная определяет вариант шаблона данного виджета
    public $tpl;
    
    //Здесь хранятся записи о всех категориях из БД (массив категорий)
    public $data;
    
    //Здесь хранится дерево - результат работы функции, которая построит из обычного массива массив дерева (визуально видно вложенность категорий)
    public $tree;
    
    //Хранится готовый html-аод в зависимости от типа шаблона, определенного в $tpl
    public $menuHtml;
    
    public function init() {
        //Сначала вызвали родительский метод
        parent::init();
        
        //Автоподставление в $tpl по умолчанию, если параметр не передан
        if($this->tpl === null) {
            $this->tpl = 'menu';
        }
        //Добавили расширение файла php
        $this->tpl .= '.php';
    }
    
    public function run() {
        //indexBy() приводит в соответствие (переиндексирует) идентификаторы массива с переданным в функцию полем (ключевое поле = 'id') - 
        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);
        //debug($this->tree);
        //return $this->tpl;
        return $this->menuHtml;
    }
    
    //проходит массив в цикле и из обычного одномерного массива строит дерево
    protected function getTree() {
        $tree = [];
        foreach($this->data as $id => &$node) {
            if(!$node['parent_id']) {
                $tree[$id] = &$node;
            }
            else {
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            
            }
        }
        return $tree;
    }
    
    //здесь свойство $tree передаем в функ. как параметр (а не используем в ней как свойство), 
    //потому что hetMenuHtml($tree) не проходит весь массив целиком
    //Функция работает с одним узлом(категорией)
    protected function getMenuHtml($tree) {
        //Сюда помещается готовый hthl-код
        $str = '';
        foreach($tree as $category) {
            //Передаем в catToTemplate каждый конкретный элемент дерева
            $str .= $this->catToTemplate($category);
        }
        return $str;
    }
    
    //принимает параметром переданный элемент "категория" и возвращает буферизированный вывод
    protected function catToTemplate($category) {
        ob_start();
        //и помещает его в шаблон
        include __DIR__ . '/menu_tpl/' . $this->tpl;
        //буферизация - для запрета вывода в браузер. Буферизируем вывод (ob_start), а затем возврящаем, не выводя на экран
        return ob_get_clean();
    }
    
}