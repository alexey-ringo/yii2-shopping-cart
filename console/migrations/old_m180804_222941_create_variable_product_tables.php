<?php

use yii\db\Migration;

/**
 * Class m180804_222941_create_variable_product_tables
 */
class m180804_222941_create_variable_product_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%variable_product}}', [
            'id' => $this->primaryKey()->unsigned(),
            'sku' => $this->integer(11)->notNull()->unique()->unsigned(),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(0),
        ]);
        
        $this->createTable('{{%value_variable_product}}', [
            //'id' => $this->primaryKey(),
            'var_product_id' => $this->integer(11)->unsigned(),
            'value_id' => $this->integer(11)->unsigned(),
        ]);
        
        $this->addPrimaryKey('pk-value_variable_product', '{{%value_variable_product}}', ['var_product_id', 'value_id']);
        $this->createIndex('idx-value_variable_product-var_product_id', '{{%value_variable_product}}', 'var_product_id');
        $this->createIndex('idx-value_variable_product-value_id', '{{%value_variable_product}}', 'value_id');
        $this->addForeignKey('fk-value_variable_product-variable_product', '{{%value_variable_product}}', 'var_product_id', '{{%variable_product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-value_variable_product-value', '{{%value_variable_product}}', 'value_id', '{{%value}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*
        echo "m180804_222941_create_variable_product_tables cannot be reverted.\n";

        return false;
        */
        $this->dropTable('{{%variable_product}}');
        $this->dropTable('{{%value_variable_product}}');
        
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180804_222941_create_variable_product_tables cannot be reverted.\n";

        return false;
    }
    */
}
