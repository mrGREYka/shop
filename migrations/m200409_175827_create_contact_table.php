<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact}}`.
 */
class m200409_175827_create_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150),
            'email' => $this->string(100),
            'phone' => $this->string(50)->notNull()->unique(),
        ]);

        $this->addColumn('contact','partner_id', $this->integer( )->notNull() );
        $this->createIndex( 'idx-contact-partner_id', 'contact', 'partner_id' );
        $this->addForeignKey('fk-contact-partner_id', 'contact', 'partner_id', 'partner', 'id' );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact}}');
    }
}
