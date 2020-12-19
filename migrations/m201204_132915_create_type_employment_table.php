<?php

use app\models\TypeEmployment;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%TypeEmployment}}`.
 */
class m201204_132915_create_type_employment_table extends Migration
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
        
        $this->addTypeEmployment('Полная занятость');
        $this->addTypeEmployment('Частичная занятость');
        $this->addTypeEmployment('Проектная/Временная работа');
        $this->addTypeEmployment('Волонтёрство');
        $this->addTypeEmployment('Стажировка');
    }
    
    /**
     * Adds type employment.
     * 
     * @param string $nameTypeEmployment
     */
    public function addTypeEmployment(string $nameTypeEmployment) {
        $typeEmployment = TypeEmployment::getNewTypeEmployment($nameTypeEmployment);
        $typeEmployment->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type_employment}}');
    }
}
