<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property int $id
 * @property string $name
 *
 * @property ResumeSchedule[] $resumeSchedules
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * Returns new schedule;
     * 
     * @param string $nameSchedule
     * @return \app\models\Schedule
     */
    public static function getNewSchedule(string $nameSchedule){
        $schedule = new Schedule();
        $schedule->name = $nameSchedule;
        return $schedule;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResumeSchedules()
    {
        return $this->hasMany(ResumeSchedule::className(), ['schedule_id' => 'id']);
    }
    
    public function getScheduleByIdResume(int $idResume) : array {
        $strQuery = <<<EOT
                    SELECT "schedule"."name"
                    FROM "schedule"
                    INNER JOIN "resume_schedule"
                        ON "schedule"."id"="resume_schedule"."schedule_id"
                    INNER JOIN "resume"
                        ON "resume_schedule"."resume_id"="resume"."id"
                    WHERE "resume"."id"=:idResume
                    EOT;
        
        $command = Yii::$app->db->createCommand($strQuery);
        $command->bindValue(':idResume', $idResume);
        $resultQuery = $command->queryAll();
        return $resultQuery;
    }
    
}
