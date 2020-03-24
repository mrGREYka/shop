<?php

use yii\db\Migration;

/**
 * Handles the creation of table `group_product`.
 */
class m200324_100007_create_group_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

            $this->createTable('group_product', [
                'id' => $this->primaryKey(),
                'title' => $this->string(),
                'content' => $this->text(),

            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('group_product');
    }
}
