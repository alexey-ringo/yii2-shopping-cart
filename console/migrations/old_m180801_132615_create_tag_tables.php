<?php

use yii\db\Migration;

/**
 * Class m180801_132615_create_tag_tables
 */
class m180801_132615_create_tag_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(11)->unsigned(),
            'name' => $this->string(255)->notNull(),
        ]);
        $this->createIndex('idx-tag-name', '{{%tag}}', 'name');
        
        $this->createTable('{{%product_tag}}', [
            'product_id' => $this->integer(11)->notNull()/*->unique()*/->unsigned(),
            'tag_id' => $this->integer(11)->notNull()->unsigned(),
        ]);
        $this->addPrimaryKey('pk-product_tag', '{{%product_tag}}', ['product_id', 'tag_id']);
        $this->createIndex('idx-product_tag-product_id', '{{%product_tag}}', 'product_id');
        $this->createIndex('idx-product_tag-tag_id', '{{%product_tag}}', 'tag_id');
        $this->addForeignKey('fk-product_tag-product', '{{%product_tag}}', 'product_id', '{{%product}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-product_tag-tag', '{{%product_tag}}', 'tag_id', '{{%tag}}', 'id', 'CASCADE', 'RESTRICT');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*
        echo "m180801_132615_create_tag_tables cannot be reverted.\n";

        return false;
        */
        $this->dropTable('{{%product_tag}}');
        $this->dropTable('{{%tag}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180801_132615_create_tag_tables cannot be reverted.\n";

        return false;
    }
    */
}
