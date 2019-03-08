<?php

use yii\db\Migration;

/**
 * Class m190306_214001_alter_columt_create_table_order
 */
class m190306_214001_alter_columt_create_table_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn( 'order', 'created', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP') );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190306_214001_alter_columt_create_table_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190306_214001_alter_columt_create_table_order cannot be reverted.\n";

        return false;
    }
    */
}
