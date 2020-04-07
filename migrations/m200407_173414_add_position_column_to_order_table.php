<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%order}}`.
 */
class m200407_173414_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'weight', $this->decimal(10,3 ) );
        $this->addColumn('{{%order}}', 'num_pack', $this->integer( ) );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
