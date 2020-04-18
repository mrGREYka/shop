<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price_product}}`.
 */
class m200418_151422_create_price_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%price_product}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'min_count' => $this->integer(),
            'price' => $this->decimal(19,2),
        ]);

        $this->createIndex( 'idx-price_product-product_id', 'price_product', 'product_id' );

        $this->addForeignKey('fk-price_product-product_id', 'price_product', 'product_id', 'product', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%price_product}}');
    }
}
