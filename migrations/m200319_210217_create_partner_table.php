<?php

use yii\db\Migration;

/**
 * Handles the creation of table `partner`.
 */
class m200319_210217_create_partner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('partner', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150),
            'email' => $this->string(100),
            'phone' => $this->string(50)->notNull()->unique(),
            'type' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('partner');
    }
}
