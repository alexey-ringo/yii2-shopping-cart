<?php

use yii\db\Migration;

/**
 * Class m180805_211531_create_product_tables
 */
class m180805_211531_create_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //Create table 'product'
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'category_id' => $this->integer(11)->notNull()->unsigned(),
            'code' => $this->integer(11)->notNull()->unique()->unsigned(),
            'name' => $this->string(255)->notNull(),
            //'slug' => $this->string(128)->notNull()->unique(),
            'variable' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'content' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'meta_title' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'meta_description' => $this->string(255),
            'hit' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'new' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        ]);
        
        $this->createIndex('idx-product-category_id', '{{%product}}', 'category_id');
        $this->createIndex('idx-product-id', '{{%product}}', 'id');
        $this->createIndex('idx-product-status', '{{%product}}', 'status');
        $this->addForeignKey('fk-product-category', '{{%product}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'RESTRICT');
        
        
        //Create table 'image_product'
        $this->createTable('{{%image_product}}', [
            'id' => $this->primaryKey(11),
            'product_id' => $this->integer()->notNull()->unsigned(),
            //'product_code' => $this->integer(11)->notNull()->unique()->unsigned(),
            'img1' => $this->string(255)->defaultValue('no-image.png'),
            'img2' => $this->string(255)->defaultValue('no-image.png'),
            'img3' => $this->string(255)->defaultValue('no-image.png'),
            'img4' => $this->string(255)->defaultValue('no-image.png'),
            'img5' => $this->string(255)->defaultValue('no-image.png'),
            'img6' => $this->string(255)->defaultValue('no-image.png'),
        ]);
        
        $this->createIndex('idx-image_product-product_id', '{{%image_product}}', 'product_id');
        $this->addForeignKey('fk-image_product-product', '{{%image_product}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        
        
        //Create table 'product_variable'
         $this->createTable('{{%product_variable}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'product_id' => $this->integer(11)->notNull()->unsigned(),
            'sku' => $this->integer(11)->notNull()->unique()->unsigned(),
            'name' => $this->string(255)->notNull(),
            //'slug' => $this->string(128)->notNull()->unique(),
            //'content' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'qty' => $this->integer(11)->unsigned(),
        ]);
        
        $this->createIndex('idx-product_variable-product_id', '{{%product_variable}}', 'product_id');
        $this->createIndex('idx-product_variable-sku', '{{%product_variable}}', 'sku');
        $this->createIndex('idx-product_variable-price', '{{%product_variable}}', 'price');
        $this->createIndex('idx-product_variable-status', '{{%product_variable}}', 'status');
        $this->addForeignKey('fk-product_variable-product', '{{%product_variable}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        
        //Create table 'attribute' - названия атрибутов
        $this->createTable('{{%attribute}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->unique()->notNull(),
            'descr' => $this->text(),
            'type' => $this->string(255)->notNull()->defaultValue('string'),
            'variants' => $this->string(255),
        ]);
        
        
        //Create table 'attribute_value' - значения атрибутов
        $this->createTable('{{%attribute_value}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'attribute_id' => $this->integer(11)->notNull()->unsigned(),
            //'name' => $this->string(255)->unique()->notNull(),
            'value_str' => $this->string(255)->notNull(),
            'value_int' => $this->integer(11)->notNull()->defaultValue(0),
            'descr' => $this->text(),
        ]);
        
        $this->createIndex('idx-attribute_value-attribute_id', '{{%attribute_value}}', 'attribute_id');
        $this->createIndex('idx-attribute_value-value_int', '{{%attribute_value}}', 'value_int');
        $this->addForeignKey('fk-attribute_value-attribute', '{{%attribute_value}}', 'attribute_id', '{{%attribute}}', 'id', 'CASCADE', 'RESTRICT');
        
        
        //Create table 'product_attribute_value'
        $this->createTable('{{%product_attribute_value}}', [
            //'id' => $this->primaryKey(11)->unsigned(),
            'product_id' => $this->integer(11)->notNull()->unsigned(),
            'attribute_value_id' => $this->integer(11)->notNull()->unsigned(),
        ]);
        
        $this->addPrimaryKey('pk-product_attribute_value', '{{%product_attribute_value}}', ['product_id', 'attribute_value_id']);
        $this->addForeignKey('fk-product_attribute_value-attribute_value', '{{%product_attribute_value}}', 'attribute_value_id', '{{%attribute_value}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product_attribute_value-product', '{{%product_attribute_value}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        
        
        //Create table 'product_variable_attribute_value'
        $this->createTable('{{%product_variable_attribute_value}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'product_variable_id' => $this->integer(11)->notNull()->unsigned(),
            'attribute_value_id' => $this->integer(11)->notNull()->unsigned(),
        ]);
        
        $this->addForeignKey('fk-product_variable_attribute_value-product_variable', '{{%product_variable_attribute_value}}', 'product_variable_id', '{{%product_variable}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product_variable_attribute_value-attribute_value', '{{%product_variable_attribute_value}}', 'attribute_value_id', '{{%attribute_value}}', 'id', 'CASCADE', 'RESTRICT');
        
        
        $this->batchInsert('{{%product}}',
            ['category_id', 'code', 'name', 'variable', 'content', 'price', 'hit', 'new', 'status'],
            [
                [4, 1041000, 'Байкерская куртка из искусственной замши', 1, 'Байкерская куртка из искусственной замши', 2099, 1, 1, 1],
                [4, 1041002, 'Джинсовая куртка', 'Джинсовая куртка', 0,  1799, 0, 0, 1],
                [4, 1041003, 'Джинсовая куртка в стиле oversize', 0, 'Джинсовая куртка в стиле oversize', 2799, 0, 1, 1],
                [4, 1041004, 'Короткая куртка с капюшоном', 0, 'Короткая куртка с капюшоном', 1820, 0, 0, 1],
                [4, 1041005, 'Куртка из искусственной овчины с капюшоном', 0, 'Куртка из искусственной овчины с капюшоном', 3999, 1, 1, 1],
                [4, 1041006, 'Куртка короткая с капюшоном', 0, 'Куртка короткая с капюшоном', 2090, 0, 0, 1],
                [4, 1041007, 'Куртка-бомбер', 0, 'Куртка-бомбер', 1799, 0, 1, 1],
                [4, 1041008, 'Куртка-кенгуру', 0, 'Куртка-кенгуру', 2099, 0, 0, 1],
                [4, 1041009, 'Стеганая куртка с круглым вырезом', 1, 'Стеганая куртка с круглым вырезом', 2799, 1, 0, 1],
                [4, 1041010, 'Укороченная куртка', 0, 'Укороченная куртка', 1500, 0, 0, 1],
                [4, 1041011, 'Укороченная куртка в байкерском стиле', 0, 'Укороченная куртка в байкерском стиле', 2599, 1, 1, 1],
                        
                [6, 1061000, 'Блейзер', 1, 'Блейзер', 2250, 0, 0, 1],
                [6, 1061002, 'Блейзер в тонкую черную полоску', 0, 'Блейзер в тонкую черную полоску', 2450, 1, 1, 1],
                [6, 1061003, 'Блейзер струящегося покроя с подворачивающимися рукавами', 0, 'Блейзер струящегося покроя с подворачивающимися рукавами', 2499, 0, 0, 1],
                [6, 1061004, 'Пиджак с лампасами', 0, 'Пиджак с лампасами', 1820, 1, 0, 1],
                [6, 1061005, 'Пиджак с лампасами черный', 0, 'Пиджак с лампасами черный', 1450, 0, 1, 1],
                    
                [9, 1091000, 'Ддинсы mom fit с высокой талией', 0, 'Ддинсы mom fit с высокой талией', 2300, 1, 1, 1],
                [9, 1091002, 'Джеггинсы с высокой талией', 0, 'Джеггинсы с высокой талией', 2200, 0, 0, 1],
                [9, 1091003, 'Джинсы с широкими штанинами и высокой талией', 0, 'Джинсы с широкими штанинами и высокой талией', 2199, 0, 1, 1],
                [9, 1091004, 'Джинсы с эффектом пуш-ап и мягкой посадкой', 0, 'Джинсы с эффектом пуш-ап и мягкой посадкой', 1920, 0, 0, 1],
                [9, 1091005, 'Джинсы скинни с высокой посадкой', 0, 'Джинсы скинни с высокой посадкой', 1999, 1, 1, 1],
                [9, 1091006, 'Расклешенные джинсы', 0, 'Расклешенные джинсы', 2090, 0, 0, 1],
                [9, 1091007, 'Укороченные джинсы прямого кроя с высокой талией и разрывами', 0, 'Укороченные джинсы прямого кроя с высокой талией и разрывами', 2099, 0, 1, 1],
                        
                [12, 1121000, 'Короткий сарафан', 0, 'Короткий сарафан', 2250, 0, 0, 1],
                [12, 1121002, 'Короткое белое платье', 0, 'Короткое белое платье', 2450, 1, 1, 1],
                [12, 1121003, 'Платье на бретелях с бантами', 0, 'Платье на бретелях с бантами', 2499, 0, 0, 1],
                [12, 1121004, 'Платье с короткими рукавами', 0, 'Платье с короткими рукавами', 1820, 1, 0, 1],
            ]);
                    
                    
                    
        
        $this->batchInsert('{{%image_product}}',
            ['product_id', 'img1', 'img2', 'img3', 'img4', 'img5', 'img6'],
            [
                [/*1041000*/1, '10410001.jpg', '10410002.jpg', '10410003.jpg', '10410004.jpg', '10410005.jpg', '10410006.jpg'],
                [/*1041002*/2, '10410021.jpg', '10410022.jpg', '10410023.jpg', '10410024.jpg', '10410025.jpg', '10410026.jpg'],
                [/*1041003*/3, '10410031.jpg', '10410032.jpg', '10410033.jpg', '10410034.jpg', '10410035.jpg', '10410036.jpg'],
                [/*041004*/4, '10410041.jpg', '10410042.jpg', '10410043.jpg', '10410044.jpg', '10410045.jpg', '10410046.jpg'],
                [/*1041005*/5, '10410051.jpg', '10410052.jpg', '10410053.jpg', '10410054.jpg', '10410055.jpg', '10410056.jpg'],
                [/*1041006*/6, '10410061.jpg', '10410062.jpg', '10410063.jpg', '10410064.jpg', '10410065.jpg', '10410066.jpg'],
                [/*1041007*/7, '10410071.jpg', '10410072.jpg', '10410073.jpg', '10410074.jpg', '10410075.jpg', '10410076.jpg'],
                [/*1041008*/8, '10410081.jpg', '10410082.jpg', '10410083.jpg', '10410084.jpg', '10410085.jpg', '10410086.jpg'],
                [/*1041009*/9, '10410091.jpg', '10410092.jpg', '10410093.jpg', '10410094.jpg', '10410095.jpg', '10410096.jpg'],
                [/*1041010*/10, '10410101.jpg', '10410102.jpg', '10410103.jpg', '10410104.jpg', '10410105.jpg', '10410106.jpg'],
                [/*1041011*/11, '10410111.jpg', '10410112.jpg', '10410113.jpg', '10410114.jpg', '10410115.jpg', '10410116.jpg'],
                        
                [/*1061000*/12, '10610001.jpg', '10610002.jpg', '10610003.jpg', '10610004.jpg', '10610005.jpg', '10610006.jpg'],
                [/*1061002*/13, '10610021.jpg', '10610022.jpg', '10610023.jpg', '10610024.jpg', '10610025.jpg', '10610026.jpg'],
                [/*1061003*/14, '10610031.jpg', '10610032.jpg', '10610033.jpg', '10610034.jpg', '10610035.jpg', '10610036.jpg'],
                [/*1061004*/15, '10610041.jpg', '10610042.jpg', '10610043.jpg', '10610044.jpg', '10610045.jpg', '10610046.jpg'],
                [/*1061005*/16, '10610051.jpg', '10610052.jpg', '10610053.jpg', '10610054.jpg', '10610055.jpg', '10610056.jpg'],
                        
                [/*1091000*/17, '10910001.jpg', '10910002.jpg', '10910003.jpg', '10910004.jpg', '10910005.jpg', '10910006.jpg'],
                [/*1091002*/18, '10910021.jpg', '10910022.jpg', '10910023.jpg', '10910024.jpg', '10910025.jpg', '10910026.jpg'],
                [/*1091003*/19, '10910031.jpg', '10910032.jpg', '10910033.jpg', '10910034.jpg', '10910035.jpg', '10910036.jpg'],
                [/*1091004*/20, '10910041.jpg', '10910042.jpg', '10910043.jpg', '10910044.jpg', '10910045.jpg', '10910046.jpg'],
                [/*1091005*/21, '10910051.jpg', '10910052.jpg', '10910053.jpg', '10910054.jpg', '10910055.jpg', '10910056.jpg'],
                [/*1091006*/22, '10910061.jpg', '10910062.jpg', '10910063.jpg', '10910064.jpg', '10910065.jpg', '10910066.jpg'],
                [/*1091007*/23, '10910071.jpg', '10910072.jpg', '10910073.jpg', '10910074.jpg', '10910075.jpg', '10910076.jpg'],
                        
                [/*1121000*/24, '11210001.jpg', '11210002.jpg', '11210003.jpg', '11210004.jpg', '11210005.jpg', '11210006.jpg'],
                [/*1121002*/25, '11210021.jpg', '11210022.jpg', '11210023.jpg', '11210024.jpg', '11210025.jpg', '11210026.jpg'],
                [/*1121003*/26, '11210031.jpg', '11210032.jpg', '11210033.jpg', '11210034.jpg', '11210035.jpg', '11210036.jpg'],
                [/*1121004*/27, '11210041.jpg', '11210042.jpg', '11210043.jpg', '11210044.jpg', '11210045.jpg', '11210046.jpg'],
                        
            ]);
                    
                    
        $this->batchInsert('{{%product_variable}}',
            ['product_id', 'sku', 'name', 'price', 'status', 'qty'],
            [
                [1, 104100001, 'Байкерская куртка из искусственной замши красная S', 2099, 1, 20],
                [1, 104100002, 'Байкерская куртка из искусственной замши красная M', 2099, 1, 15],
                [1, 104100003, 'Байкерская куртка из искусственной замши красная L', 2099, 1, 17],
                [1, 104100004, 'Байкерская куртка из искусственной замши зеленая S', 2099, 1, 16],
                [1, 104100005, 'Байкерская куртка из искусственной замши зеленая M', 2099, 1, 40],
                [1, 104100006, 'Байкерская куртка из искусственной замши зеленая L', 2099, 1, 10],
                [1, 104100007, 'Байкерская куртка из искусственной замши синяя S', 2099, 1, 16],
                [1, 104100008, 'Байкерская куртка из искусственной замши синяя M', 2099, 1, 40],
                [1, 104100009, 'Байкерская куртка из искусственной замши синяя L', 2099, 1, 10],        
                        
                [9, 104100901, 'Стеганая куртка с круглым вырезом красная S', 2799, 1, 30],
                [9, 104100902, 'Стеганая куртка с круглым вырезом красная M', 2799, 1, 40],
                [9, 104100903, 'Стеганая куртка с круглым вырезом красная L', 2799, 1, 20],
                [9, 104100904, 'Стеганая куртка с круглым вырезом зеленая S', 2799, 1, 15],
                [9, 104100905, 'Стеганая куртка с круглым вырезом зеленая M', 2799, 1, 37],
                [9, 104100906, 'Стеганая куртка с круглым вырезом зеленая L', 2799, 1, 32],
                [9, 104100907, 'Стеганая куртка с круглым вырезом синяя S', 2799, 1, 34],
                [9, 104100908, 'Стеганая куртка с круглым вырезом синяя M', 2799, 1, 25],
                [9, 104100909, 'Стеганая куртка с круглым вырезом синяя L', 2799, 1, 31],
                
                [12, 106100001, 'Блейзер желтый S', 2250, 1, 12],
                [12, 106100002, 'Блейзер желтый M', 2250, 1, 12],
                [12, 106100003, 'Блейзер желтый L', 2250, 1, 12],
                [12, 106100004, 'Блейзер зеленый S', 2250, 1, 12],
                [12, 106100005, 'Блейзер зеленый M', 2250, 1, 12],
                [12, 106100006, 'Блейзер зеленый L', 2250, 1, 12],
                
                [17, 109100001, 'Ддинсы mom fit с высокой талией размер 28', 2300, 1, 23],
                [17, 109100002, 'Ддинсы mom fit с высокой талией размер 29', 2300, 1, 25],
                [17, 109100003, 'Ддинсы mom fit с высокой талией размер 30', 2300, 1, 20],
                
                [27, 112100401, 'Платье с короткими рукавами синее размер 44', 1820, 1, 15],
                [27, 112100402, 'Платье с короткими рукавами синее размер 46', 1820, 1, 17],
                [27, 112100403, 'Платье с короткими рукавами синее размер 48', 1820, 1, 16],
                [27, 112100404, 'Платье с короткими рукавами черное размер 44', 1820, 1, 14],
                [27, 112100405, 'Платье с короткими рукавами черное размер 46', 1820, 1, 19],
                [27, 112100406, 'Платье с короткими рукавами черное размер 48', 1820, 1, 18],
            ]);
                    
        $this->batchInsert('{{%attribute}}',
            ['name', 'descr', 'type', 'variants'],
            [
                ['Цвет', '', '', ''],
                ['Размер', '', '', ''],
            ]);
                    
        $this->batchInsert('{{%attribute_value}}',
            ['attribute_id', 'value_str', 'descr'],
            [
                [1, 'Красный', ''],
                [1, 'Зеленый', ''],
                [1, 'Синий', ''],
                [2, 'S', ''],
                [2, 'M', ''],
                [2, 'L', ''],
                [1, 'Желтый', ''],
                [2, '28', ''],
                [2, '29', ''],
                [2, '30', ''],
                [2, '44', ''],
                [2, '46', ''],
                [2, '48', ''],
                [1, 'Черный', ''],
            ]);
            
        $this->batchInsert('{{%product_attribute_value}}',
            ['product_id', 'attribute_value_id'],
            [
                [1, 1],
                [1, 2],
                [1, 3],
                [1, 4],
                [1, 5],
                [1, 6],
                [9, 1],
                [9, 2],
                [9, 3],
                [9, 4],
                [9, 5],
                [9, 6],
                [12, 7],
                [12, 2],
                [12, 4],
                [12, 5],
                [12, 6],
                [17, 8],
                [17, 9],
                [17, 10],
                [27, 3],
                [27, 14],
                [27, 11],
                [27, 12],
                [27, 13],
            ]);
        
        $this->batchInsert('{{%product_variable_attribute_value}}',
            ['product_variable_id', 'attribute_value_id'],
            [
                [1, 1],
                [1, 4],
                [2, 1],
                [2, 5],
                [3, 1],
                [3, 6],
                [4, 2],
                [4, 4],
                [5, 2],
                [5, 5],
                [6, 2],
                [6, 6],
                [7, 3],
                [7, 4],
                [8, 3],
                [8, 5],
                [9, 3],
                [9, 6],
                
                [10, 1],
                [10, 4],
                [11, 1],
                [11, 5],
                [12, 1],
                [12, 6],
                [13, 2],
                [13, 4],
                [14, 2],
                [14, 5],
                [15, 2],
                [15, 6],
                [16, 3],
                [16, 4],
                [17, 3],
                [17, 5],
                [18, 3],
                [18, 6],
                
                [19, 7],
                [19, 4],
                [20, 7],
                [20, 5],
                [21, 7],
                [21, 6],
                [22, 2],
                [22, 4],
                [23, 2],
                [23, 5],
                [24, 2],
                [24, 6],
                
                [25, 8],
                [26, 9],
                [27, 10],
                
                [28, 3],
                [28, 11],
                [29, 3],
                [29, 12],
                [30, 3],
                [30, 13],
                [31, 14],
                [31, 11],
                [32, 14],
                [32, 12],
                [33, 14],
                [33, 13],
                
                
                
            ]);    
    

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*
        echo "m180805_211531_create_product_tables cannot be reverted.\n";

        return false;
        */
        //Drop indexes and table 'product_variable_attribute_value'
        $this->dropForeignKey(
            'fk-product_variable_attribute_value-product_variable', 
            '{{%product_variable_attribute_value}}'
        );
        $this->dropForeignKey(
            'fk-product_variable_attribute_value-attribute_value', 
            '{{%product_variable_attribute_value}}'
        );
        
        $this->delete('{{%product_variable_attribute_value}}');
        $this->dropTable('{{%product_variable_attribute_value}}');
        
        
        //Drop indexes and table 'product_attribute_value'
        $this->dropForeignKey(
            'fk-product_attribute_value-attribute_value', 
            '{{%product_attribute_value}}'
        );
        $this->dropForeignKey(
            'fk-product_attribute_value-product', 
            '{{%product_attribute_value}}'
        );
        $this->delete('{{%product_attribute_value}}');
        $this->dropTable('{{%product_attribute_value}}');
        
        
        
        
        //Drop indexes and table 'attribute_value'
        $this->dropForeignKey(
            'fk-attribute_value-attribute', 
            '{{%attribute_value}}'
        );
        $this->dropIndex(
            'idx-attribute_value-attribute_id', 
            '{{%attribute_value}}'
        );
        $this->dropIndex(
            'idx-attribute_value-value_int', 
            '{{%attribute_value}}'
        );
        $this->delete('{{%attribute_value}}');
        $this->dropTable('{{%attribute_value}}');
        
        
        //Drop indexes and table 'attribute'
        $this->delete('{{%attribute}}');
        $this->dropTable('{{%attribute}}');
        
        
        
        
        //Drop indexes and table 'product_variable'
        $this->dropForeignKey(
            'fk-product_variable-product', 
            '{{%product_variable}}'
        );
        
        $this->dropIndex(
            'idx-product_variable-product_id', 
            '{{%product_variable}}'
        );
        
        $this->dropIndex(
            'idx-product_variable-sku', 
            '{{%product_variable}}'
        );
        
        $this->dropIndex(
            'idx-product_variable-price', 
            '{{%product_variable}}'
        );
        
        $this->dropIndex(
            'idx-product_variable-status', 
            '{{%product_variable}}'
        );
        
        $this->delete('{{%product_variable}}');
        $this->dropTable('{{%product_variable}}');
        
        
        
        
        //Drop indexes and table 'image_product'
        $this->dropForeignKey(
            'fk-image_product-product',
            '{{%product}}'
        );
        
        $this->dropIndex(
            'idx-image_product-product_id', 
            '{{%image_product}}'
        );
        
        $this->delete('{{%image_product}}');
        $this->dropTable('{{%image_product}}');
        
        
        
        
        //Drop indexes and table 'product'
        $this->dropIndex(
            'idx-product-status',
            '{{%product}}'
        );
        
        $this->dropIndex(
            'idx-product-category_id',
            '{{%product}}'
        );
        
        $this->delete('{{%product}}');
        $this->dropTable('{{%product}}');
        
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180805_211531_create_product_tables cannot be reverted.\n";

        return false;
    }
    */
}
