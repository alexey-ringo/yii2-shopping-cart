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
        $this->createTable('order_items', [
            'id' => $this->primaryKey()->unsigned(),
            'order_id' => $this->integer(11)->notNull()->unsigned(),
            'product_id' => $this->integer(11)->notNull()->unsigned(),
            //'product_slug' => $this->string(128)->notNull()->unique(),
            'name' => $this->string(255)->notNull(),
            'price' => $this->decimal(10, 2)->notNull(),
            'qty_item' => $this->integer(11)->notNull(),
            'sum_item' => $this->decimal(10, 2)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_items');
    }
}
