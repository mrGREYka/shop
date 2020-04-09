<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%order}}`.
 */
class m200409_190003_add_position_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%order}}', 'contact_id', $this->integer());

        $this->createIndex( 'idx-order-contact_id', 'order', 'contact_id' );

        $this->addForeignKey('fk-order-contact_id', 'order', 'contact_id', 'contact', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%order}}', 'contact_id');
    }
}
