<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "specialization".
 *
 * @property int $id
 * @property string $name
 *
 * @property PlaceOfWork[] $placeOfWorks
 */
class Specialization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'specialization';
    }
    
     /**
      * Returns new specialization.
      * 
      * @param string $name
      * @return \app\models\Specialization
      */
    public static function getNewSpecialization(string $name) {
        $specialization = new Specialization();
        $specialization->name = $name;
        return $specialization;
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
    
    public function getAllSpecializations(): array {
        $strQuery = 'SELECT id, name FROM "specialization"';
        $command = Yii::$app->db->createCommand($strQuery);
        $resultQuery = $command->queryAll();
        return $resultQuery;
    }

    public function getNameSpecializationById(int $id): string {
        $strQuery = 'SELECT name FROM "specialization" where "id"=:id';
        $command = Yii::$app->db->createCommand($strQuery);
        $command->bindValue(':id', $id);
        $resultQuery = $command->queryOne();
        return $resultQuery['name'];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceOfWorks()
    {
        return $this->hasMany(PlaceOfWork::className(), ['specialization_id' => 'id']);
    }
}
