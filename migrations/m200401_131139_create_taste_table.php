<?php

use yii\db\Migration;

/**
 * Handles the creation of table `taste`.
 */
class m200401_131139_create_taste_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('taste', [
            'id' => $this->primaryKey(),
            'title' => $this->string(250),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('taste');
    }
}
