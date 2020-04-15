<?php

use yii\db\Migration;

/**
 * Class m200405_222325_add_product_file_table
 */
class m200405_222325_add_product_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->createTable('file_product', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'title' => $this->string(255),
            'filename' => $this->string(255),
            'filepath' => $this->string(255),
            'filename_thumb' => $this->string(255),
            'filepath_thumb' => $this->string(255),
        ]);


        $this->createIndex( 'idx-file_product-product_id', 'file_product', 'product_id' );

        $this->addForeignKey('fk-file_product-product_id', 'file_product', 'product_id', 'product', 'id' );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200405_222325_add_product_file_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200405_222325_add_product_file_table cannot be reverted.\n";

        return false;
    }
    */
}
