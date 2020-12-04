<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%TypeEmployment}}`.
 */
class m201204_132915_create_TypeEmployment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_employment}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name' => $this->string(50)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_employment}}');
    }
}
