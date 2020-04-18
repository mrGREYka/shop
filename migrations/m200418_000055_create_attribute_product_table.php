<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute_product}}`.
 */
class m200418_000055_create_attribute_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attribute_product}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'title' => $this->string(255),
            'content' => $this->string(255),

        ]);

        $this->createIndex( 'idx-attribute_product-product_id', 'attribute_product', 'product_id' );

        $this->addForeignKey('fk-attribute_product-product_id', 'attribute_product', 'product_id', 'product', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attribute_product}}');
    }
}
