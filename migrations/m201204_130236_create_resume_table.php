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
            'photo' => $this->string(255),
            'salary' => $this->integer(11)->notNull(),
            'about_me' => \yii\db\pgsql\Schema::TYPE_TEXT,
            'user_id' => $this->integer(11)->notNull(),
        ]);
        $this->addForeignKey('fk_resume_user_id', 'resume', 'user_id', 
            'user', 'id', 'cascade', 'cascade');

        $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE name=:name');
        $command->bindValue(':name', 'Anton');
        $post = $command->queryOne();
        
        $idUser = $post['id'];
        $resume = Resume::getNewResume('100', 'about me!', '---', $idUser);
        $resume->save();
        
        $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE name=:name');
        $command->bindValue(':name', 'Anna');
        $post = $command->queryOne();
        
        $idUser = $post['id'];
        $resume = Resume::getNewResume('200', 'about me for Anna!', '---', $idUser);
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
