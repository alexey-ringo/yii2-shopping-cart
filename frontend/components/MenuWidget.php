<?php

namespace app\components;

use yii\base\Widget;

class MenuWidget extends Widget {
    //Переменная определяет вариант шаблона данного виджета
    public $tpl;
    
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
        return $this->tpl;
    }
}