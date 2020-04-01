<?php

use yii\db\Migration;

/**
 * Handles adding position to table `item_order`.
 */
class m200401_135140_add_position_column_to_item_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('item_order', 'taste_id', $this->integer());

        $this->createIndex(
            'idx-item_order-taste_id',
            'item_order',
            'taste_id'
        );

        $this->addForeignKey(
            'fk-item_order-taste_id',
            'item_order',
            'taste_id',
            'taste',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('item_order', 'taste_id');
    }
}
