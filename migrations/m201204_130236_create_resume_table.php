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
            'user_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('fk_resume_user_id', 'resume', 'user_id', 
            'user', 'id', 'cascade', 'cascade');

        $this->addresume('Anton', 'Lavrov', '1990-02-18', 'Manager', 100, 'about me');
        $this->addresume('Anna', 'Mironova', '1992-11-25', 'Director' ,200, 'about me');
    }
    
    public function addresume(string $nameUser, string $surnameUser, string $dateBirth, string $nameResume, int $salary, string $aboutMe) {
        $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE name=:name AND surname=:surname AND date_birth=:date_birth');
        $command->bindValue(':name', $nameUser);
        $command->bindValue(':surname', $surnameUser);
        $command->bindValue(':date_birth', $dateBirth);
        $post = $command->queryOne();
        
        $idUser = $post['id'];
        $resume = Resume::getNewResume($nameResume, $salary, $aboutMe, '---', $idUser);
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
