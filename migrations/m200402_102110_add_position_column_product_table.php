<?php

use yii\db\Migration;

/**
 * Class m200402_102110_add_position_column_product_table
 */
class m200402_102110_add_position_column_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product', 'has_box', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200402_102110_add_position_column_product_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200402_102110_add_position_column_product_table cannot be reverted.\n";

        return false;
    }
    */
}
