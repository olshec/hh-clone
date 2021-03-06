<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $telephone
 * @property string $date_birth
 * @property int $city
 * @property string $gender
 *
 * @property Resume[] $resumes
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }
    
    /**
     *  Returns new user.
     *  
     * @param string $name
     * @param string $surname
     * @param string $patronymic
     * @param string $email
     * @param string $telephone
     * @param string $date_birth
     * @param int $idCity
     * @param string $gender
     * @return \app\models\User
     */
    public static function getNewUser(string $name, string $surname, string $patronymic, string $email, string $telephone, 
        string $date_birth, int $idCity, string $gender) {
        $user = new User();
        $user->name = $name;
        $user->surname = $surname;
        $user->patronymic = $patronymic;
        $user->email = $email;
        $user->telephone = $telephone;
        $user->date_birth = $date_birth;
        $user->city_id = $idCity;
        $user->gender = $gender;
        return $user;
    }
    
    public function getUserById(int $id): array {
        $command = Yii::$app->db->createCommand('SELECT * FROM "user" where id=:id');
        $command->bindValue(':id', $id);
        $user = $command->queryOne();
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'telephone', 'date_birth', 'city_id', 'gender'], 'required'],
            [['date_birth'], 'safe'],
            [['gender'], 'string'],
            [['name', 'surname', 'patronymic', 'email', 'telephone'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'date_birth' => 'Date Birth',
            'city_id' => 'city_id',
            'gender' => 'Gender',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumes()
    {
        return $this->hasMany(Resume::className(), ['user_id' => 'id']);
    }
}
