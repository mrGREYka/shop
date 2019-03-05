<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m190302_184204_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'number' => $this->integer(10),
            'email' => $this->string(100),
            'username' => $this->string(100),
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
