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
 * @property string $city
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
     * Returns new user.
     * 
     * @param unknown $name
     * @param unknown $surname
     * @param unknown $email
     * @param unknown $telephone
     * @param unknown $date_birth
     * @param unknown $city
     * @param unknown $gender
     * @return \app\models\User
     */
    public static function getNewUser($name, $surname, $email, $telephone, $date_birth, $city, $gender) {
        $user = new User();
        $user->name = $name;
        $user->surname = $surname;
        $user->email = $email;
        $user->telephone = $telephone;
        $user->date_birth = $date_birth;
        $user->city = $city;
        $user->gender = $gender;
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'telephone', 'date_birth', 'city', 'gender'], 'required'],
            [['date_birth'], 'safe'],
            [['gender'], 'string'],
            [['name', 'surname', 'email', 'telephone'], 'string', 'max' => 50],
            [['city'], 'string', 'max' => 100],
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
            'city' => 'City',
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
