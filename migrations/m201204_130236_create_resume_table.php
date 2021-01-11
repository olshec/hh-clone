<?php

use yii\db\Migration;
use app\models\Resume;
use app\models\User;


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
            'name' => $this->string(255)->notNull(),
            'photo' => $this->string(255),
            'salary' => $this->integer(11)->notNull(),
            'about_me' => \yii\db\pgsql\Schema::TYPE_TEXT,
            'date_update' => $this->dateTime()->notNull(),
            'number_views' => $this->integer(11)->notNull(),
            'date_publication' => $this->dateTime()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('fk_resume_user_id', 'resume', 'user_id', 
            'user', 'id', 'cascade', 'cascade');

        $this->addResume('Anton', 'Lavrov', '1990-02-18', 'Менеджер персонала', 
            120000, 'about me', 'Anton_Lavrov_1990-02-18_37485948/photo-1.jpeg', '2019-10-20 20:05', 43, '2019-10-20 20:05');
        $this->addResume('Anna', 'Mironova', '1992-11-25', 'Директор по развитию бизнеса' ,
            140000, 'about me', 'Anna_Mironova_1992-11-25_34758693/photo-5.jpg', '2020-8-7 16:05', 23, '2020-8-7 16:05');
        $this->addResume('Anna', 'Mironova', '1992-11-25', 'Менеджер по продажам',
            110000, 'about me', 'Anna_Mironova_1992-11-25_34758693/photo-7.jpg', '2019-5-26 16:05', 12, '2019-5-26 16:05');
        
        $this->addResume('Ekaterina', 'Shahmotova', '1997-12-30', 'Java middle developer', 
            70000, 'about me', 'Ekaterina_Shahmotova_1997-12-30_57689034/photo-6.jpeg', '2020-11-14 16:05', 20, '2020-11-14 15:00');
        
        $this->addResume('Andrey', 'Rumov', '1999-08-11', 'Python sinior developer' , 
            200000, 'about me', 'Andrey_Rumov_2001-08-11_576890435/photo-2.jpg', '2020-1-5 16:05', 40, '2020-1-5 11:05');
        $this->addResume('Andrey', 'Rumov', '1999-08-11', 'PHP middle developer' ,
            200000, 'about me', 'Andrey_Rumov_2001-08-11_576890435/photo-2.jpg', '2020-1-5 16:15', 25, '2020-1-5 8:15');
        $this->addResume('Andrey', 'Rumov', '1999-08-11', 'Java middle developer' ,
            200000, 'about me', 'Andrey_Rumov_2001-08-11_576890435/photo-2.jpg', '2020-1-5 16:35', 34, '2020-1-5 14:35');
        $this->addResume('Andrey', 'Rumov', '1999-08-11', 'C# sinior developer' ,
            200000, 'about me', 'Andrey_Rumov_2001-08-11_576890435/photo-2.jpg', '2020-1-5 16:45', 12, '2020-1-5 12:45');
        $this->addResume('Andrey', 'Rumov', '1999-08-11', 'C++ sinior developer' ,
            200000, 'about me', 'Andrey_Rumov_2001-08-11_576890435/photo-2.jpg', '2020-1-5 16:55', 11, '2020-1-5 10:55');
    }
    
    /**
     * Adds new resume.
     * 
     * @param string $nameUser
     * @param string $surnameUser
     * @param string $dateBirth
     * @param string $nameResume
     * @param int $salary
     * @param string $aboutMe
     * @param string $photo
     * @param string $dateUpdate
     */
    public function addResume(string $nameUser, string $surnameUser, string $dateBirth, 
        string $nameResume, int $salary, string $aboutMe, string $photo, string $dateUpdate, int $numberViews, string $datePublication) {
        $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE name=:name AND surname=:surname AND date_birth=:date_birth');
        $command->bindValue(':name', $nameUser);
        $command->bindValue(':surname', $surnameUser);
        $command->bindValue(':date_birth', $dateBirth);
        $post = $command->queryOne();
        
        $idUser = $post['id'];
        $resume = Resume::getNewResume($nameResume, $salary, $aboutMe, $photo, $dateUpdate, $numberViews, $datePublication, $idUser);
        $resume->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%resume}}');
    }
}
