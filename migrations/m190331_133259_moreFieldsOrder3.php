<?php

use yii\db\Migration;

/**
 * Class m190331_133259_moreFieldsOrder3
 */
class m190331_133259_moreFieldsOrder3 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'order', 'product_name', $this->string ( 150 ) );
        $this->addColumn( 'order', 'type_name', $this->string ( 150 ) );
        $this->addColumn( 'order', 'taste_name', $this->string ( 150 ) );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190331_133259_moreFieldsOrder3 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190331_133259_moreFieldsOrder3 cannot be reverted.\n";

        return false;
    }
    */
}
