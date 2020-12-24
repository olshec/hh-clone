<?php

use app\models\City;
use yii\db\Migration;

/**
 * Class m201224_133439_city_table
 */
class m201200_133439_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%city}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name' => $this->string(50)->notNull(),
        ]);
        
        $this->addCity('Кемерово');
        $this->addCity('Новосибирск');
        $this->addCity('Иркутск');
        $this->addCity('Красноярск');
        $this->addCity('Барнаул');
    }
    
    private function addCity(string $name) {
        $city = City::getNewCity($name);
        $city->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m201224_133439_city_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201224_133439_city_table cannot be reverted.\n";

        return false;
    }
    */
}
