<?php

use yii\db\Migration;
use app\models\ResumeSchedule;

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
        
        $this->addResumeSchedule('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 'Полный день');
        $this->addResumeSchedule('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 'Удалённая работа');
               
        $this->addResumeSchedule('Anna', 'Mironova', '1992-11-25', 'Директор по развитию бизнеса', 'Полный день');
        $this->addResumeSchedule('Anna', 'Mironova', '1992-11-25', 'Директор по развитию бизнеса', 'Удалённая работа');
              
        $this->addResumeSchedule('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Полный день');
        $this->addResumeSchedule('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Сменный график');
        $this->addResumeSchedule('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Гибкий график');
        $this->addResumeSchedule('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Удалённая работа');
        $this->addResumeSchedule('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Вахтовый метод');
               
        $this->addResumeSchedule('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Полный день');              
        $this->addResumeSchedule('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Сменный график');           
        $this->addResumeSchedule('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Гибкий график');            
        $this->addResumeSchedule('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Удалённая работа');         
        $this->addResumeSchedule('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Вахтовый метод');           
              
        $this->addResumeSchedule('Andrey', 'Rumov', '2001-08-11', 'Python sinior developer', 'Полный день');
        $this->addResumeSchedule('Andrey', 'Rumov', '2001-08-11', 'Python sinior developer', 'Гибкий график');
        $this->addResumeSchedule('Andrey', 'Rumov', '2001-08-11', 'Python sinior developer', 'Удалённая работа');
    }
    
    /**
     * Adds new ResumeSchedule in database.
     *
     * @param string $nameUser
     * @param string $surnameUser
     * @param string $dateBirth
     * @param string $nameResume
     * @param string $typeSchedule
     */
    public function addResumeSchedule(string $nameUser, string $surnameUser, string $dateBirth, string $nameResume, string $typeSchedule) {
        $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE name=:name AND surname=:surname AND date_birth=:date_birth');
        $command->bindValue(':name', $nameUser);
        $command->bindValue(':surname', $surnameUser);
        $command->bindValue(':date_birth', $dateBirth);
        $post = $command->queryOne();
        $idUser = $post['id'];
        
        $command = Yii::$app->db->createCommand('SELECT * FROM "resume" WHERE name=:name AND user_id=:user_id');
        $command->bindValue(':name', $nameResume);
        $command->bindValue(':user_id', $idUser);
        $post = $command->queryOne();
        $idResume = $post['id'];
        
        $command = Yii::$app->db->createCommand('SELECT * FROM "schedule" WHERE name=:name');
        $command->bindValue(':name', $typeSchedule);
        $post = $command->queryOne();
        $idTypeSchedule = $post['id'];
        
        $resumeSchedule = ResumeSchedule::getNewResumeSchedule($idResume, $idTypeSchedule);
        $resumeSchedule->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resume_schedule}}');
    }
}
