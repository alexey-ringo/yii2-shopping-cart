<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attr_order`.
 */
class m180803_103835_create_attr_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attr_order}}', [
            'attr_val_id' => $this->integer(11)->unsigned(),
            'order_id' => $this->integer(11)->unsigned(),
        ]);
        
        $this->addPrimaryKey('pk-attr_order', '{{%attr_order}}', ['attr_val_id', 'order_id']);
        $this->createIndex('idx-attr_val_id', '{{%attr_order}}', 'attr_val_id');
        $this->createIndex('idx-order_id', '{{%attr_order}}', 'order_id');
        $this->addForeignKey('fk-attr_val_id-value', '{{%attr_order}}', 'attr_val_id', '{{%value}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-order_id-order', '{{%attr_order}}', 'order_id', '{{%order_items}}', 'id', 'CASCADE', 'RESTRICT');
        
    }
    
    
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attr_order}}');
    }
}
