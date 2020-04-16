<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%partner}}`.
 */
class m200416_093000_add_position_column_to_partner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%partner}}', 'comment', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%partner}}', 'comment');
    }
}
