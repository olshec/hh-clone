<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume_type_employment".
 *
 * @property int $id
 * @property int $resume_id
 * @property int $type_employment_id
 *
 * @property Resume $resume
 * @property TypeEmployment $typeEmployment
 */
class ResumeTypeEmployment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume_type_employment';
    }

    /**
     * Creates new ResumeTypeEmployment.
     * 
     * @param int $resumeId
     * @param int $typeEmploymentId
     * @return \app\models\ResumeTypeEmployment
     */
    public static function getNewResumeTypeEmployment(int $resumeId, int $typeEmploymentId) {
        $resumeTypeEmployment = new ResumeTypeEmployment();
        $resumeTypeEmployment->resume_id = $resumeId;
        $resumeTypeEmployment->type_employment_id = $typeEmploymentId;
        return $resumeTypeEmployment;
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'type_employment_id'], 'required'],
            [['resume_id', 'type_employment_id'], 'default', 'value' => null],
            [['resume_id', 'type_employment_id'], 'integer'],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['type_employment_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeEmployment::className(), 'targetAttribute' => ['type_employment_id' => 'id']],
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
            'type_employment_id' => 'Type Employment ID',
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
    public function getTypeEmployment()
    {
        return $this->hasOne(TypeEmployment::className(), ['id' => 'type_employment_id']);
    }
}
