<?php

use yii\db\Migration;

/**
 * Class m190204_185934_user
 */
class m190204_185934_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'user', 'fild_number_cad', $this->integer( 3 )->after( 'fild_number' ) );
        $this->addColumn( 'user', 'phone', $this->string( 20 )->after( 'email' ) );
        $this->addColumn( 'user', 'pass_series', $this->string( 5 ) );
        $this->addColumn( 'user', 'pass_number', $this->string( 6 ) );
        $this->addColumn( 'user', 'pass_given', $this->string( 100 ) );
        $this->addColumn( 'user', 'post_code', $this->integer( 6 ) );
        $this->addColumn( 'user', 'entity_rf', $this->string ( 50 ) );
        $this->addColumn( 'user', 'city', $this->string ( 30 ) );
        $this->addColumn( 'user', 'region', $this->string ( 50 ) );
        $this->addColumn( 'user', 'settlement', $this->string ( 50 ) );
        $this->addColumn( 'user', 'street', $this->string ( 50 ) );
        $this->addColumn( 'user', 'house_number', $this->integer ( 3 ) );
        $this->addColumn( 'user', 'building_number', $this->integer ( 3 ) );
        $this->addColumn( 'user', 'apartment_number', $this->integer ( 3 ) );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190204_185934_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190204_185934_user cannot be reverted.\n";

        return false;
    }
    */
}
