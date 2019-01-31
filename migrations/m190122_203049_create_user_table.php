<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m190122_203049_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string(100),
            'email' => $this->string(100),
            'password' => $this->string(40),
            'fild_number' => $this->integer(3),
            'authKey' => $this->string(100),
            'accessToken' => $this->string(100),
            'status' => $this->integer(1)->defaultValue(0),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
