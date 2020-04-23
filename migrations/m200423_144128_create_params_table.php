<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%params}}`.
 */
class m200423_144128_create_params_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%params}}', [
            'id' => $this->primaryKey(),
            'three_shiping_sum' => $this->integer(),
            'cdek_url' => $this->string(255),
            'up_1' => $this->integer(),
            'up_2' => $this->integer(),
        ]);

        $this->insert('{{%params}}', [
            'three_shiping_sum' => 1800,
            'cdek_url' => 'https://cdek.ru/offices',
            'up_1' => 50,
            'up_2' => 20,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%params}}');
    }
}
