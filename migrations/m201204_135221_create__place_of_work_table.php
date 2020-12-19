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
        

        $this->addPlaceOfWork('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 'Маркетинг', 'ООО Новый-тренд', '2014-02-11', '2015-01-25', '----');
        $this->addPlaceOfWork('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 'Маркетинг', 'HVC', '2015-01-28', '2017-03-12', '----');
        
        $this->addPlaceOfWork('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Продажи', 'ООО Северная столица', '2016-11-25', '2017-11-24', '----');
        $this->addPlaceOfWork('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам', 'Развитие бизнеса', 'ООО Северная столица', '2016-11-25', '2017-11-24', '----');
        $this->addPlaceOfWork('Anna', 'Mironova', '1992-11-25', 'Директор по развитию бизнеса', 
            'Развитие бизнеса', 'ООО Северная столица', '2017-11-25', '2019-08-25', '----');
        
        
        $this->addPlaceOfWork('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Программирование, Разработка', 'ООО Спутник', '2016-03-16', '2018-05-10', '----');
        $this->addPlaceOfWork('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Программирование, Разработка', 'ИП Красников', '2018-06-20', '2019-02-22', '----');
        $this->addPlaceOfWork('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 'Программирование, Разработка', 'ОАО Стелс', '2019-03-26', '2020-07-11', '----');
        
        $this->addPlaceOfWork('Andrey', 'Rumov', '2001-08-11', 'Python sinior developer', 'Программирование, Разработка', 'High tecnology', '2018-11-25', '2019-08-27', '----');
        $this->addPlaceOfWork('Andrey', 'Rumov', '2001-08-11', 'Python sinior developer', 'Программирование, Разработка', 'SkyTech', '2019-10-25', '2020-07-20', '----');
    
    }

    /**
     * Adds new PlaceOfWork.
     * 
     * @param string $nameUser
     * @param string $surnameUser
     * @param string $dateBirth
     * @param string $nameResume
     * @param string $specialization
     * @param string $name_organization
     * @param string $date_start
     * @param string $date_end
     * @param string $resp_func_ach
     */
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
