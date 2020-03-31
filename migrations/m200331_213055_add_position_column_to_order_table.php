<?php

use yii\db\Migration;

/**
 * Handles adding position to table `order`.
 */
class m200331_213055_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'status');
    }
}
