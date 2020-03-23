<?php

use yii\db\Migration;

/**
 * Handles adding position to table `order`.
 */
class m200323_091051_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'user_id', $this->integer());

        $this->createIndex( 'idx-order-user_id', 'order', 'user_id' );

        $this->addForeignKey('fk-post-user_id', 'order', 'user_id', 'user', 'id' );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_id', 'user');
    }
}
