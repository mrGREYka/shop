<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%order}}`.
 */
class m201012_211613_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'order', 'comment_user', $this->text() );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
