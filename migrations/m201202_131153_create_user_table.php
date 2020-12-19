<?php

use yii\db\Migration;
use app\models\User;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m201202_131153_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name' => $this->string(50)->notNull(),
            'surname' => $this->string(50)->notNull(),
            'email' => $this->string(50)->notNull(),
            'telephone' => $this->string(50)->notNull(),
            'date_birth' => $this->date()->notNull(),
            'city' => $this->string(100)->notNull(),
            'gender' => 'gender_enum NOT NULL',
        ]);
        
        $this->addUser('Anton', 'Lavrov', 'lAnton@gmail.com', '+79202943874', '1990-02-18', 'Moscow', 'male');
        $this->addUser('Anna', 'Mironova', 'anmir@yandex.com', '+79203459845', '1992-11-25', 'Tula', 'female');
        $this->addUser('Ekaterina', 'Shahmotova', 'katsh@gmail.com', '+79209384756', '1997-12-30', 'Krasnodar', 'female');
        $this->addUser('Andrey', 'Rumov', 'andreyrum@yahoo.com', '+79204859764', '2001-08-11', 'Lipeck', 'male');
    }
    
    /**
     * Adds new user.
     * 
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $telephone
     * @param string $date_birth
     * @param string $city
     * @param string $gender
     */
    public function addUser(string $name, string $surname, string $email, string $telephone, string $date_birth, string $city, string $gender) {
        $user = User::getNewUser($name, $surname, $email, $telephone, $date_birth, $city, $gender) ;
        $user->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
