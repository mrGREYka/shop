<?php

use yii\db\Migration;

/**
 * Handles the creation of table `item_order`.
 */
class m200325_165413_create_item_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('item_order', [
            'id' => $this->primaryKey(),
        ]);

        $this->addColumn('item_order', 'order_id', $this->integer());

        $this->createIndex( 'idx-item_order-order_id', 'item_order', 'order_id' );

        $this->addForeignKey('fk-item_order-order_id', 'item_order', 'order_id', 'order', 'id' );


        $this->addColumn('item_order', 'group_product_id', $this->integer());

        $this->createIndex( 'idx-item_order-group_product_id', 'item_order', 'group_product_id' );

        $this->addForeignKey('fk-item_order-group_product_id', 'item_order', 'group_product_id', 'group_product', 'id' );


        $this->addColumn('item_order', 'product_id', $this->integer());

        $this->createIndex( 'idx-item_order-product_id', 'item_order', 'product_id' );

        $this->addForeignKey('fk-item_order-product_id', 'item_order', 'product_id', 'product', 'id' );

        $this->addColumn('item_order', 'count', $this->integer( ) );
        $this->addColumn('item_order', 'price', $this->decimal( 19,2 ) );
        $this->addColumn('item_order', 'sum', $this->decimal( 19,2 ) );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('item_order');
    }
}
