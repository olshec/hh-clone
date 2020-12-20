<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place_of_work".
 *
 * @property int $id
 * @property string $name_organization
 * @property string $position
 * @property string $date_start
 * @property string $date_end
 * @property string|null $resp_func_ach
 * @property int $resume_id
 * @property int $specialization_id
 *
 * @property Resume $resume
 * @property Specialization $specialization
 */
class PlaceOfWork extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place_of_work';
    }
    
    /**
     * Returns new PlaceOfWork.
     *
     * @param string $name_organization
     * @param string $position
     * @param string $date_start
     * @param string $date_end
     * @param string $resp_func_ach
     * @param int $resume_id
     * @param int $specialization_id
     * @return \app\models\PlaceOfWork
     */
    public static function getNewPlaceOfWork(string $name_organization, string $position, string $date_start, 
        string $date_end, string $resp_func_ach, int $resume_id, int $specialization_id) {
        $placeOfWork = new PlaceOfWork();
        $placeOfWork->name_organization = $name_organization;
        $placeOfWork->position = $position;
        $placeOfWork->date_start = $date_start;
        $placeOfWork->date_end = $date_end;
        $placeOfWork->resp_func_ach = $resp_func_ach;
        $placeOfWork->resume_id = $resume_id;
        $placeOfWork->specialization_id = $specialization_id;
        return $placeOfWork;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_organization', 'position', 'date_start', 'date_end', 'resume_id', 'specialization_id'], 'required'],
            [['date_start', 'date_end'], 'safe'],
            [['resp_func_ach'], 'string'],
            [['resume_id', 'specialization_id'], 'default', 'value' => null],
            [['resume_id', 'specialization_id'], 'integer'],
            [['name_organization', 'position'], 'string', 'max' => 50],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::className(), 'targetAttribute' => ['resume_id' => 'id']],
            [['specialization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Specialization::className(), 'targetAttribute' => ['specialization_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_organization' => 'Name Organization',
            'position' => 'Position',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'resp_func_ach' => 'Resp Func Ach',
            'resume_id' => 'Resume ID',
            'specialization_id' => 'Specialization ID',
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
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::className(), ['id' => 'specialization_id']);
    }
}
