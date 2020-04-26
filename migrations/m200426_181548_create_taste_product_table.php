<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%taste_product}}`.
 */
class m200426_181548_create_taste_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%taste_product}}', [
            'id' => $this->primaryKey(),
        ]);


        $this->addColumn('taste_product', 'product_id', $this->integer());

        $this->createIndex( 'idx-taste_product-product_id', 'taste_product', 'product_id' );

        $this->addForeignKey('fk-taste_product-product_id', 'taste_product', 'product_id', 'product', 'id' );


        $this->addColumn('taste_product', 'taste_id', $this->integer());

        $this->createIndex( 'idx-taste_product-taste_id', 'taste_product', 'taste_id' );

        $this->addForeignKey('fk-taste_product-taste_id', 'taste_product', 'taste_id', 'taste', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%taste_product}}');
    }
}
