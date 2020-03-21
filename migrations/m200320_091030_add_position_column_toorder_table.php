<?php

use yii\db\Migration;

/**
 * Class m200320_091030_add_position_column_toorder_table
 */
class m200320_091030_add_position_column_toorder_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order','partner_id', $this->integer( )->notNull() );

        $this->createIndex( 'idx-order-partner_id', 'order', 'partner_id' );

        $this->addForeignKey('fk-post-author_id', 'order', 'partner_id', 'partner', 'id' );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200320_091030_add_position_column_toorder_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200320_091030_add_position_column_toorder_table cannot be reverted.\n";

        return false;
    }
    */
}
