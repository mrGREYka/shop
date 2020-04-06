<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%item_order}}`.
 */
class m200406_092517_add_position_column_to_item_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{item_order}}', 'foil', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%item_order}}', 'foil');
    }
}
