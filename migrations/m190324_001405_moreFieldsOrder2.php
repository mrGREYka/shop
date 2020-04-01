<?php

use yii\db\Migration;

/**
 * Class m190324_001405_moreFieldsOrder2
 */
class m190324_001405_moreFieldsOrder2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'order', 'dost', $this->integer( 1 )->after( 'address') );
        $this->addColumn( 'order', 'datefinish', $this->string ( 50 )->after( 'dost') );
        $this->addColumn( 'order', 'timefinish', $this->string ( 50 )->after( 'datefinish') );
        $this->addColumn( 'order', 'comment', $this->string ( 200 )->after( 'timefinish') );
        $this->addColumn( 'order', 'message', $this->string ( 200 )->after( 'comment') );
        $this->addColumn( 'order', 'promocode', $this->string ( 200 )->after( 'message') );
        $this->addColumn( 'order', 'product_id', $this->integer ( 10 ) );
        $this->addColumn( 'order', 'type_id', $this->integer ( 10 ) );
        $this->addColumn( 'order', 'taste_id', $this->integer ( 10 ) );
        $this->addColumn( 'order', 'count', $this->integer ( 10 ) );
        $this->addColumn( 'order', 'sum', $this->decimal( 19, 2 ) );
        $this->addColumn( 'order', 'uri', $this->string ( 150 ) );
        $this->addColumn( 'order', 'url', $this->string ( 150 ) );
        $this->addColumn( 'order', 'has_box', $this->integer ( 1 ) );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190324_001405_moreFieldsOrder2 cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190324_001405_moreFieldsOrder2 cannot be reverted.\n";

        return false;
    }
    */
}
