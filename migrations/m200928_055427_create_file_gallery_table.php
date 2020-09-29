<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file_gallery}}`.
 */
class m200928_055427_create_file_gallery_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file_gallery}}', [
            'id' => $this->primaryKey(),
            'gallery_id' => $this->integer(),
            'title' => $this->string(255),
            'filename' => $this->string(255),
            'filepath' => $this->string(255),
            'filename_thumb' => $this->string(255),
            'filepath_thumb' => $this->string(255),
        ]);

        $this->createIndex( 'idx-file_gallery-gallery_id', 'file_gallery', 'gallery_id' );
        $this->addForeignKey('fk-file_gallery-gallery_id', 'file_gallery', 'gallery_id', 'gallery', 'id' );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file_gallery}}');
    }
}
