<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%params}}`.
 */
class m200424_094044_add_position_column_to_params_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('params', 'pickup',        $this->integer( ) );
        $this->addColumn('params', 'price_сourier', $this->integer( ) );
        $this->addColumn('params', 'russia_mail',   $this->integer( ) );

        $this->update('params', [
            'pickup' => 200,
            'price_сourier' => 250,
            'russia_mail' => 250,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
