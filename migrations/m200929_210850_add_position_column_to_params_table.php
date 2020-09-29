<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%params}}`.
 */
class m200929_210850_add_position_column_to_params_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%params}}', 'gallery_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%params}}', 'gallery_id');
    }
}
