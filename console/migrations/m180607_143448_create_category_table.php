<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180607_143448_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'parent_id' => $this->integer(11)->notNull()->defaultValue(0)->unsigned(),
            'name' => $this->string(255)->notNull(),
            //'slug' => $this->string(128)->notNull()->unique(),
            'description' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'img' => $this->string(255)->defaultValue('no-image.png'),
            'meta_title' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'meta_description' => $this->string(255),
            
            
        ]);
        //Creates secondary index for column `parent_id`
        $this->createIndex('idx-category-parent_id', '{{%category}}', 'parent_id');
        
        //('имя ключа', 'из какой табл', 'из какого поля', 'на какую табл', 'на какое поле', 'действия со связностями при удалении', '')
        //Имя ключа - 'Таблица - имя связи'
        //$this->addForeignKey('fk-category-parent', '{{%category}}', 'parent_id', '{{%category}}', 'id', 'SET NULL', 'RESTRICT');
        
        
        
        $this->batchInsert('{{%category}}',
                    ['parent_id', 'name'],
                    [
                        [0, 'Одежда'],
                        [0, 'Обувь'],
                        [0, 'Аксессуары'],
                        /*[1, 'Новая коллекция'], */
                        [1, 'Куртки'],
                        [1, 'Пальто'],
                        [1, 'Пиджаки'],
                        [1, 'Костюмы'],
                        [1, 'Брюки'],
                        [1, 'Джинсы'],
                        [1, 'Комбинезоны'],
                        [1, 'Юбки'],
                        [1, 'Платья'],
                        [1, 'Рубашки'],
                        [1, 'Свитера'],
                        [1, 'Толстовки'],
                        [1, 'Вязанные изделия'],
                        [1, 'Футболки'],
                        [1, 'Шорты'],
                        [1, 'Боди'],
                        [1, 'Топы'],
                        [1, 'Купальники'],
                        [1, 'Белье'],
                        [2, 'Новая коллекция'],
                        [2, 'Все'],
                        [2, 'Туфли на каблуке'],
                        [2, 'Босоножки на каблуке'],
                        [2, 'Кроссовки и кеды'],
                        [2, 'Сандалии'],
                        [2, 'Обувь на платформе'],
                        [2, 'Обуфь на плоской подошве'],
                        [2, 'Сапоги'],
                        [2, 'Ботинки'],
                        [2, 'Ботильоны'],
                        [3, 'Новая коллекция'],
                        [3, 'Сумки'],
                        [3, 'Ремни'],
                        [3, 'Кошельки'],
                        [3, 'Очки'],
                        [3, 'Шляпы, шапки'],
                        [3, 'Шарфы'],
                        [3, 'Платки'],
                        [3, 'Украшения'],
                        
                    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `category`
        
        $this->dropForeignKey(
            'fk-category-parent',
            '{{%category}}'
        );
        
        
        // drops secondary index for column `parent_id`
        $this->dropIndex(
            'idx-category-parent_id',
            '{{%category}}'
        );
        
        $this->delete('{{%category}}');
        $this->dropTable('{{%category}}');
    }
}
