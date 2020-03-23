<?php

use yii\db\Migration;

/**
 * Handles dropping position from table `user`.
 */
class m200321_160440_drop_position_column_from_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'fild_number');
        $this->dropColumn('user', 'fild_number_cad');
        $this->dropColumn('user', 'pass_series');
        $this->dropColumn('user', 'pass_number');
        $this->dropColumn('user', 'pass_given');
        $this->dropColumn('user', 'post_code');
        $this->dropColumn('user', 'entity_rf');
        $this->dropColumn('user', 'city');
        $this->dropColumn('user', 'region');
        $this->dropColumn('user', 'settlement');
        $this->dropColumn('user', 'street');
        $this->dropColumn('user', 'house_number');
        $this->dropColumn('user', 'building_number');
        $this->dropColumn('user', 'apartment_number');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
