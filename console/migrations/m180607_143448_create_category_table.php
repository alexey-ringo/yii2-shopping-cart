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
        $this->createTable('category', [
            'id' => $this->primaryKey()->notNull()->unsigned(),
            'parent_id' => $this->integer(10)->notNull()->defaultValue(0)->unsigned(),
            'name' => $this->string(255)->notNull(),
            //'slug' => $this->string(128)->notNull()->unique(),
            'description' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'img' => $this->string(255)->defaultValue('no-image.png'),
            'meta_title' => $this->string(255),
            'meta_keywords' => $this->string(255),
            'meta_description' => $this->string(255),
            
            
        ]);
        
        $this->batchInsert('category',
                    ['parent_id', 'name'],
                    [
                        [0, 'Sportswear'],
                        [0, 'Mens'],
                        [0, 'Womens'],
                        [1, 'Nike'],
                        [1, 'Under Armour'],
                        [1, 'Adidas'],
                        [1, 'Puma'],
                        [1, 'ASICS'],
                        [2, 'Fendi'],
                        [2, 'Guess'],
                        [2, 'Valentino'],
                        [2, 'Dior'],
                        [2, 'Versace'],
                        [2, 'Armani'],
                        [2, 'Prada'],
                        [2, 'Dolce and Gabbana'],
                        [2, 'Chanel'],
                        [2, 'Gucci'],
                        [3, 'Fendi'],
                        [3, 'Guess'],
                        [3, 'Valentino'],
                        [3, 'Dior'],
                        [3, 'Versace'],
                        [0, 'Kids'],
                        [0, 'Fashion'],
                        [0, 'Households'],
                        [0, 'Interiors'],
                        [0, 'Clothing'],
                        [0, 'Bags'],
                        [0, 'Shoes'],
                    ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('category');
        $this->dropTable('category');
    }
}
