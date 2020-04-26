<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%order}}`.
 */
class m200426_131516_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'sum_delivery', $this->decimal( 19, 2 ) );
        $this->addColumn('{{%order}}', 'sum_total', $this->decimal( 19, 2 ) );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
