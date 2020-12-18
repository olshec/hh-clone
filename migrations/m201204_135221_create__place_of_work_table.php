<?php

use app\models\PlaceOfWork;
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
        

        $this->addPlaceOfWork('Anton', 'Lavrov', '1990-02-18', 'Manager', 'Маркетинг', 'HVC', '2015-01-11', '2017-03-12', '----');
        $this->addPlaceOfWork('Anna', 'Mironova', '1992-11-25', 'Director', 'Продажи', 'ООО Северная столица', '2017-11-25', '2019-08-25', '----');
    }

    public function addPlaceOfWork(string $nameUser, string $surnameUser, string $dateBirth, string $nameResume, string $specialization, 
        string $name_organization, string $date_start, string $date_end, string $resp_func_ach){
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
        
        $command = Yii::$app->db->createCommand('SELECT * FROM "specialization" WHERE name=:name');
        $command->bindValue(':name', $specialization);
        $post = $command->queryOne();
        $idSpecialization= $post['id'];
        
        $placeOfWork = PlaceOfWork::getNewPlaceOfWork($name_organization, $date_start,
            $date_end, $resp_func_ach, $idResume, $idSpecialization); 
        $placeOfWork->save();
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%place_of_work}}');
    }
}
