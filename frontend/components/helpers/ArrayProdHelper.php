<?php

namespace frontend\components\helpers;

use yii\base\Component;
use Yii;

class ArrayProdHelper extends Component {
    private $attrValKey;
    private $valStrKey;
    private $valIntKey;
    private $arrAttrKey;
    private $attrKey;
    
    //Инициализация строковыми константами - ключами таблиц AttrValue, Value и Attr
    public function __construct() {
        $this->attrValKey = Yii::$app->params['attrValKey'];
        $this->valStrKey = Yii::$app->params['valStrKey'];
        $this->valIntKey = Yii::$app->params['valIntKey'];
        $this->arrAttrKey = Yii::$app->params['arrAttrKey'];
        $this->attrKey = Yii::$app->params['attrKey'];
    }
    
    public function getAttrValArray($array) {
        $result = array();
        
        //Разбор 1-го уровня вх. массива: у Product по ключу 'attributeValues' выбираем неассоциированный массив всех Value
        foreach($array as $key => $val) {
            if ($key == $this->attrValKey) {
                //Разбор 2-го уровня вх. массива: неассоциированный массив всех Value разбираем до уровня массива с конкретным Value
                foreach($val as $key2 => $val2) {
                    //Разбор 3-го уровня вх. массива: из каждого массива с конкретным Values выбираем конечный массив со значечнием Attribute
                    foreach($val2 as $key3 => $val3) {
                        //По ключу 'value_str'
                        if ($key3 == $this->valStrKey) {
                            //Сохраняем значение Value (для полученного ниже Attribute)
                            $temp = $val3;
                            }
                        //Разбор 4-го уровня вх. массива: по ключу 'attribute1' разбираем последний вложенный массив для получения значения Attribute    
                        if ($key3 == $this->arrAttrKey) {
                            //Разбор 4-го уровня вх. массива:  
                            foreach($val3 as $key4 => $val4) {
                                //извлекаем значение Attribute и добавляем его как новый ключ ИТОГОВОГО массива
                                if ($key4 == $this->attrKey) {
                                    //Значениями у этого ключа будет массив связанных с ним Value
                                    $result[$val4][] = $temp;
                                }
                            }
                        }
                    }
                }
            }
            
        }
        
    return $result;
    }
    
}