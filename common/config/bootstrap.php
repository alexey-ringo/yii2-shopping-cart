<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

//Моя тестовая функция
function debug($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
    
}

function debugDie($arr) {
    echo '<pre>' . print_r($arr, true) . '</pre>';
    die;
}
