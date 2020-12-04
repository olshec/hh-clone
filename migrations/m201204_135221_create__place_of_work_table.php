<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%_place_of_work}}`.
 */
class m201204_135221_create__place_of_work_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%place_of_work}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name_organization' => $this->string(50)->notNull(),
            'date_start' => $this->date()->notNull(),
            'date_end' => $this->date()->notNull(),
            'resp_func_ach' => $this->text(),
            'resume_id' => $this->integer(11)->notNull(),
            'specialization_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('fk_pow_resume_id', 'place_of_work', 'resume_id',
            'resume', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_pow_specialization_id', 'place_of_work', 'specialization_id',
            'specialization', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%place_of_work}}');
    }
}
