<?php

use yii\db\Migration;

/**
 * Class m190205_182853_user
 */
class m190205_182853_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( 'user', 'name_f', $this->string ( 50 )->after( 'username') );
        $this->addColumn( 'user', 'name_i', $this->string ( 50 )->after( 'name_f') );
        $this->addColumn( 'user', 'name_o', $this->string ( 50 )->after( 'name_i') );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190205_182853_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190205_182853_user cannot be reverted.\n";

        return false;
    }
    */
}
