<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m180705_225226_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey()->unsigned(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'qty' => $this->integer(11)->notNull()->unsigned(),
            'sum' => $this->decimal(10, 2)->notNull(),
            'status' => $this->smallInteger(1)->defaultValue(0),
            'user_id' => $this->integer(10)->notNull()->defaultValue(0),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255)->notNull(),
            'email' => $this->string(255)->notNull(),
            'phone' => $this->string(255)->notNull(),
            'address' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order');
    }
}
