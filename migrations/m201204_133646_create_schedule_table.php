<?php

use app\models\Schedule;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%schedule}}`.
 */
class m201204_133646_create_schedule_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schedule}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name' => $this->string(50)->notNull(),
        ]);
        
        $this->addSchedule('Полный день');
        $this->addSchedule('Сменный график');
        $this->addSchedule('Гибкий график');
        $this->addSchedule('Удалённая работа');
        $this->addSchedule('Вахтовый метод');
    }
    
    /**
     * Adds new schedule.
     * 
     * @param string $nameSchedule
     */
    public function addSchedule(string $nameSchedule) {
        $schedule = Schedule::getNewSchedule($nameSchedule);
        $schedule->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%schedule}}');
    }
}
