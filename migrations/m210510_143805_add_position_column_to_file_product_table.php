<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%file_product}}`.
 */
class m210510_143805_add_position_column_to_file_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%file_product}}', 'sort', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%file_product}}', 'sort');
    }
}
