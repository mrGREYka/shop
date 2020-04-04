<?php

use yii\db\Migration;

/**
 * Handles the creation of table `taste_group_product`.
 */
class m200403_180435_create_taste_group_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('taste_group_product', [
            'id' => $this->primaryKey(),
        ]);

        $this->addColumn('taste_group_product', 'group_product_id', $this->integer());

        $this->createIndex( 'idx-taste_group_product-group_product_id', 'taste_group_product', 'group_product_id' );

        $this->addForeignKey('fk-taste_group_product-group_product_id', 'taste_group_product', 'group_product_id', 'group_product', 'id' );


        $this->addColumn('taste_group_product', 'taste_id', $this->integer());

        $this->createIndex( 'idx-taste_group_product-taste_id', 'taste_group_product', 'taste_id' );

        $this->addForeignKey('fk-taste_group_product-taste_id', 'taste_group_product', 'taste_id', 'taste', 'id' );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('taste_group_product');
    }
}
