<?php
namespace app\models;

use Yii;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property Users[] $users
 */
class City extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'city';
    }
    
    /**
     * Returns new city.
     *
     * @param string $name
     * @param int $id
     * @return City
     */
    public static function getNewCity(string $name) {
        $city = new City();
        $city->name = $name;
        return $city;
    }
    
    public function findNameCityById(int $id) {
        $command = Yii::$app->db->createCommand('SELECT * FROM "city" where id=:id');
        $command->bindValue(':id', $id);
        $city = $command->queryOne();
        return $city['name'];
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['city_id' => 'id']);
    }

}

