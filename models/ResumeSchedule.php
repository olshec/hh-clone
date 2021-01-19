<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume_schedule".
 *
 * @property int $id
 * @property int $resume_id
 * @property int $schedule_id
 *
 * @property Resume $resume
 * @property Schedule $schedule
 */
class ResumeSchedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume_schedule';
    }

    /**
     * Returns new ResumeSchedule.
     * 
     * @param int $idResume
     * @param int $idTypeSchedule
     * @return \app\models\ResumeSchedule
     */
    public static function getNewResumeSchedule(int $idResume, int $idTypeSchedule) {
        $resumeSchedule = new ResumeSchedule();
        $resumeSchedule->resume_id = $idResume;
        $resumeSchedule->schedule_id = $idTypeSchedule;
        return $resumeSchedule;
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'schedule_id'], 'required'],
            [['resume_id', 'schedule_id'], 'default', 'value' => null],
            [['resume_id', 'schedule_id'], 'integer'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['schedule_id'], 'exist', 'skipOnError' => true, 'targetClass' => Schedule::className(), 'targetAttribute' => ['schedule_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resume_id' => 'Resume ID',
            'schedule_id' => 'Schedule ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::className(), ['id' => 'resume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedule()
    {
        return $this->hasOne(Schedule::className(), ['id' => 'schedule_id']);
    }
}
