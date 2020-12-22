<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%order}}`.
 */
class m201221_064524_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( '{{%order}}', 'excpress_delivery_procent',    $this->decimal(19, 2));
        $this->addColumn( '{{%order}}', 'excpress_delivery_sum',        $this->decimal(19, 2));
        $this->update( 'order', [ 'excpress_delivery_procent' => 0, 'excpress_delivery_sum' => 0 ] );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'excpress_delivery_procent');
    }
}
