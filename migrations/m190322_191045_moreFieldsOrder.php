<?php

use yii\db\Migration;

/**
 * Class m190322_191045_moreFieldsOrder
 */
class m190322_191045_moreFieldsOrder extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'order', 'phone', $this->string ( 50 )->after( 'email') );
        $this->addColumn( 'order', 'address', $this->string ( 150 )->after( 'phone') );

     }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190322_191045_moreFieldsOrder cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190322_191045_moreFieldsOrder cannot be reverted.\n";

        return false;
    }
    */
}
