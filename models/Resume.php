<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $photo
 * @property int $salary
 * @property string|null $about_me
 * @property string $date_update
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
     * @param int $salary
     * @param string $about_me
     * @param string $photo
     * @param string $date_update
     * @param int $numberViews
     * @param string $datePublication
     * @param int $user_id
     * @return \app\models\Resume
     */
    public static function getNewResume(string $name, int $salary, string $about_me, string $photo, 
        string $date_update, int $numberViews, string $datePublication, int $user_id) {
        $resume = new Resume();
        $resume->name = $name;
        $resume->salary = $salary;
        $resume->about_me = $about_me;
        $resume->photo = $photo;
        $resume->date_update = $date_update;
        $resume->number_views = $numberViews;
        $resume->date_publication = $datePublication;
        $resume->user_id = $user_id;
        return $resume;
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['salary', 'user_id', 'name', 'date_update', 'number_views', 'date_publication'], 'required'],
            [['salary', 'user_id'], 'default', 'value' => null],
            [['salary', 'user_id', 'number_views',], 'integer'],
            [['about_me'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['photo'], 'string', 'max' => 255],
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
            'date_update' => 'DateUpdate',
            'number_views' => 'NumberViews', 
            'date_publication' => 'DatePublication',
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
    
    public function deleteResume(int $idResume) {
        $strQuery = <<<EOT
                    DELETE FROM "resume"
                    WHERE "resume"."id"=:idResume
                    EOT;
        $command = Yii::$app->db->createCommand($strQuery);
        $command->bindValue(':idResume', $idResume);
        $resultQuery = $command->query();
        return $resultQuery;
    }
}
