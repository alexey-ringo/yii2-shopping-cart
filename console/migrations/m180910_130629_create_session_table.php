<?php

use yii\db\Migration;

/**
 * Handles the creation of table `session`.
 */
class m180910_130629_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%session}}', [
            'id' => $this->char(64),
            'expire' => $this->integer(11),
            'data' => $this->binary(429496729)
            
        ]);
        
        $this->addPrimaryKey('session_pk', '{{%session}}', 'id' );
        $this->createIndex('DB', '{{%session}}', 'expire');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
