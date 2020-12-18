<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property string|null $photo
 * @property int $salary
 * @property string|null $about_me
 * @property int $user_id
 *
 * @property PlaceOfWork[] $placeOfWorks
 * @property User $user
 * @property ResumeSchedule[] $resumeSchedules
 * @property ResumeTypeEmployment[] $resumeTypeEmployments
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }
    
    /**
     * Returns new resume.
     * 
     * @param string $name
     * @param string $salary
     * @param string $about_me
     * @param string $photo
     * @param string $user_id
     * @return \app\models\Resume
     */
    public static function getNewResume($name, $salary, $about_me, $photo, $user_id) {
        $resume = new Resume();
        $resume->name = $name;
        $resume->salary = $salary;
        $resume->about_me = $about_me;
        $resume->photo = $photo;
        $resume->user_id = $user_id;
        return $resume;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salary', 'user_id', 'name'], 'required'],
            [['salary', 'user_id', 'name'], 'default', 'value' => null],
            [['salary', 'user_id', 'name'], 'integer'],
            [['about_me'], 'string'],
            [['photo'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'photo' => 'Photo',
            'salary' => 'Salary',
            'about_me' => 'About Me',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceOfWorks()
    {
        return $this->hasMany(PlaceOfWork::className(), ['resume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeSchedules()
    {
        return $this->hasMany(ResumeSchedule::className(), ['resume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeTypeEmployments()
    {
        return $this->hasMany(ResumeTypeEmployment::className(), ['resume_id' => 'id']);
    }
}
