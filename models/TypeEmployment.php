<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_employment".
 *
 * @property int $id
 * @property string $name
 *
 * @property ResumeTypeEmployment[] $resumeTypeEmployments
 */
class TypeEmployment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_employment';
    }
    
    /**
     * Returns new type of employment.
     * 
     * @param string $nameTypeEmployment
     * @return \app\models\TypeEmployment
     */
    public static function getNewTypeEmployment(string $nameTypeEmployment) {
        $typeEmployment = new TypeEmployment();
        $typeEmployment->name = $nameTypeEmployment;
        return $typeEmployment;
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
    public function getResumeTypeEmployments()
    {
        return $this->hasMany(ResumeTypeEmployment::className(), ['type_employment_id' => 'id']);
    }
    
    public function getTypeEmploymentByIdResume(int $idResume) : array {
        $strQuery = <<<EOT
                    SELECT "type_employment"."name"
                    FROM "type_employment"
                    INNER JOIN "resume_type_employment"
                        ON "type_employment"."id"="resume_type_employment"."type_employment_id"
                    INNER JOIN "resume"
                        ON "resume_type_employment"."resume_id"="resume"."id"
                    WHERE "resume"."id"=:idResume
                    EOT;
        
        $command = Yii::$app->db->createCommand($strQuery);
        $command->bindValue(':idResume', $idResume);
        $resultQuery = $command->queryOne();
        return $resultQuery;
    }
}
