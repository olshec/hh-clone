<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume_type_employment}}`.
 */
class m201204_133113_create_resume_type_employment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume_type_employment}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'resume_id' => $this->integer(11)->notNull(),
            'type_employment_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('fk_rte_resume_id', 'resume_type_employment', 'resume_id',
            'resume', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_rte_type_employment_id', 'resume_type_employment', 'type_employment_id',
            'type_employment', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resume_type_employment}}');
    }
}
