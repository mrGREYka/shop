<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m200324_100009_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),

        ]);

        $this->addColumn('product', 'group_product_id', $this->integer());

        $this->createIndex( 'idx-product-group_product_id', 'product', 'group_product_id' );

        $this->addForeignKey('fk-product-group_product_id', 'product', 'group_product_id', 'group_product', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product');
    }
}
