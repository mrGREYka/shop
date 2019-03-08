<?php

use yii\db\Migration;

/**
 * Handles adding created to table `order`.
 */
class m190306_210028_add_created_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'order', 'created', $this->dateTime()->after( 'id') );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
