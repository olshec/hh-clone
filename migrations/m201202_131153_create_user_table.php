<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201202_131153_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name' => $this->string(50)->notNull(),
            'surname' => $this->string(50)->notNull(),
            'email' => $this->string(50)->notNull(),
            'telephone' => $this->string(50)->notNull(),
            'date_birth' => $this->date()->notNull(),
            'city' => $this->string(100)->notNull(),
            'gender' => 'gender_enum NOT NULL',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
