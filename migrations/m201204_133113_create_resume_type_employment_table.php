<?php

use app\models\ResumeTypeEmployment;
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
        
        $this->addResumeTypeEmployment('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 'Полная занятость');
        $this->addResumeTypeEmployment('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 'Частичная занятость');
        $this->addResumeTypeEmployment('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 'Проектная/Временная работа');
        
        $this->addResumeTypeEmployment('Anna', 'Mironova', '1992-11-25', 'Директор по развитию бизнеса', 'Полная занятость');
        $this->addResumeTypeEmployment('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Полная занятость');
        $this->addResumeTypeEmployment('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Частичная занятость');
        $this->addResumeTypeEmployment('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Стажировка');
       
        $this->addResumeTypeEmployment('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Полная занятость');
        $this->addResumeTypeEmployment('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Частичная занятость');
        $this->addResumeTypeEmployment('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Проектная/Временная работа');
        $this->addResumeTypeEmployment('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Волонтёрство');
        $this->addResumeTypeEmployment('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Стажировка');
        
        $this->addResumeTypeEmployment('Andrey', 'Rumov', '1999-08-11', 'Python sinior developer', 'Полная занятость');
        $this->addResumeTypeEmployment('Andrey', 'Rumov', '1999-08-11', 'Python sinior developer', 'Проектная/Временная работа');
    }

     /**
      * Adds new ResumeTypeEmployment in database.
      * 
      * @param string $nameUser
      * @param string $surnameUser
      * @param string $dateBirth
      * @param string $nameResume
      * @param string $typeEmployment
      */
    public function addResumeTypeEmployment(string $nameUser, string $surnameUser, string $dateBirth, string $nameResume, string $typeEmployment) {
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
        
        $command = Yii::$app->db->createCommand('SELECT * FROM "type_employment" WHERE name=:name');
        $command->bindValue(':name', $typeEmployment);
        $post = $command->queryOne();
        $idTypeEmployment = $post['id'];
        
        $resumeTypeEmployment = ResumeTypeEmployment::getNewResumeTypeEmployment($idResume, $idTypeEmployment);
        $resumeTypeEmployment->save();
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resume_type_employment}}');
    }
}
