<?php

use yii\db\Migration;

/**
 * Class m180727_120148_create_attribute_tables
 */
class m180727_120148_create_attribute_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('{{%attribute}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'type' => $this->string()->notNull()->defaultValue('text'),
            //'variants' => сериализованный массив для выпадающего списка
        ]);
        
        $this->createTable('{{%value}}', [
            'product_id' => $this->integer()->notNull()->unsigned(),
            'attribute_id' => $this->integer()->notNull()->unsigned(),
            'value' => $this->string()->notNull(),
            //'value_string'
            //'value_int'
            
        ]);
        
        $this->addPrimaryKey('pk-value', '{{%value}}', ['product_id', 'attribute_id']);
        $this->createIndex('idx-value-product_id', '{{%value}}', 'product_id');
        $this->createIndex('idx-value-attribute_id', '{{%value}}', 'attribute_id');
        $this->addForeignKey('fk-value-product', '{{%value}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-value-attribute', '{{%value}}', 'attribute_id', '{{%attribute}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        //echo "m180727_120148_create_attribute_tables cannot be reverted.\n";

        //return false;
        
        $this->dropForeignKey(
            'fk-value-attribute',
            '{{%value}}'
        );
        
        $this->dropForeignKey(
            'fk-value-product',
            '{{%value}}'
        );
        
        
        $this->dropIndex(
            'idx-value-product_id',
            '{{%value}}'
        );
        
        $this->dropIndex(
            'idx-value-product_id',
            '{{%value}}'
        );
        
        $this->dropTable('{{%value}}');
        $this->dropTable('{{%attribute}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180727_120148_create_attribute_tables cannot be reverted.\n";

        return false;
    }
    */
}
