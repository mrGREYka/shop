<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orderfiles`.
 */
class m190618_221150_create_orderfiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orderfiles', [
            'id' => $this->primaryKey(),
            'id_order' => $this->integer ( 10 ),
        ]);

        $this->addForeignKey( 'fk-orderfiles-id_order', 'orderfiles', 'id_order', 'order', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orderfiles');
    }
}
