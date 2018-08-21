<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_items`.
 */
class m180705_230004_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order_items}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'order_id' => $this->integer(11)->notNull()->unsigned(),
            'product_id' => $this->integer(11)->notNull()->unsigned(),
            'product_variable_id' => $this->integer(11)->defaultValue(0)->unsigned(),
            
            //'product_slug' => $this->string(128)->notNull()->unique(),
            //'product_code' => $this->integer(11)->notNull()/*->unique()*/->unsigned(),
            //'attr_val' => $this->integer(11)->unsigned(),
            //'name' => $this->string(255)->notNull(),
            'count' => $this->integer(11)->defaultValue(1)->unsigned(),
            'price' => $this->decimal(10, 2)/*->notNull()*/,
            //'qty_item' => $this->integer(11)->notNull(),
            //'sum_item' => $this->decimal(10, 2)->notNull(),
        ]);
        
        $this->createIndex('idx-order_items-order_id', '{{%order_items}}', 'order_id');
        $this->createIndex('idx-order_items-product_id', '{{%order_items}}', 'order_id');
        //$this->addForeignKey('fk-order_items-product', '{{%order_items}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        //$this->addForeignKey('fk-order_items-product_variable', '{{%order_items}}', 'product_variable_id', '{{%product_variable}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-order_items-order', '{{%order_items}}', 'order_id', '{{%order}}', 'id', 'CASCADE', 'RESTRICT');
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*
        $this->dropForeignKey(
            'fk-order_items-product',
            '{{%order_items}}'
        );
        
        $this->dropForeignKey(
            'fk-order_items-product_variable',
            '{{%order_items}}'
        );
        */
        $this->dropForeignKey(
            'fk-order_items-order',
            '{{%order_items}}'
        );
        
        $this->dropIndex(
            'idx-order_items-order_id', 
            '{{%order_items}}'
        );
        
        $this->dropIndex(
            'idx-order_items-product_id', 
            '{{%order_items}}'
        );
        
        $this->delete('{{%order_items}}');
        $this->dropTable('{{%order_items}}');
    }
}
