<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%resume_specialization}}`.
 */
class m201204_134854_create_specialization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specialization}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specialization}}');
    }
}
