<?php

use yii\db\Migration;

/**
 * Handles adding position to table `order`.
 */
class m200404_152534_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'paid', $this->integer());
        $this->addColumn('order', 'consignment_note', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'paid');
    }
}
