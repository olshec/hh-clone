<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume}}`.
 */
class m201204_130236_create_resume_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%resume}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'salary' => $this->integer(11)->notNull(),
            'about_me' => \yii\db\pgsql\Schema::TYPE_TEXT,
            'id_user' => $this->string(50)->notNull(),
            'telephone' => $this->string(50)->notNull(),
            'date_birth' => $this->date()->notNull(),
            'city' => $this->string(100)->notNull(),
            'gender' => 'gender_enum NOT NULL',
            'photo' => $this->string(255),
            'user_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('fk_resume_user_id', 'resume', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resume}}');
    }
}
