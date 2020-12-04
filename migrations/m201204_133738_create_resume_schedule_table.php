<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume_schedule}}`.
 */
class m201204_133738_create_resume_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume_schedule}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'resume_id' => $this->integer(11)->notNull(),
            'schedule_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('fk_rs_resume_id', 'resume_schedule', 'resume_id',
            'resume', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_rs_schedule_id', 'resume_schedule', 'schedule_id',
            'schedule', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resume_schedule}}');
    }
}
