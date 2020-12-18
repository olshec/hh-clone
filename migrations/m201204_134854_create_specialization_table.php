<?php

use yii\db\Migration;
use app\models\Specialization;

/**
 * Handles the creation of table `{{%resume_specialization}}`.
 */
class m201204_134854_create_specialization_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%specialization}}', [
            'id' => \yii\db\pgsql\Schema::TYPE_PK,
            'name' => $this->string(50)->notNull()
        ]);

        $this->addSpecialization('Администратор баз данных');
        $this->addSpecialization('Аналитик');
        $this->addSpecialization('Арт-директор');
        $this->addSpecialization('Инженер');
        $this->addSpecialization('Компьютерная безопасность');
        $this->addSpecialization('Контент');
        $this->addSpecialization('Маркетинг');
        $this->addSpecialization('Мультимедиа');
        $this->addSpecialization('Оптимизация сайта (SEO)');
        $this->addSpecialization('Передача данных и доступ в интернет');
        $this->addSpecialization('Программирование, Разработка');
        $this->addSpecialization('Продажи');
        $this->addSpecialization('Продюсер');
        $this->addSpecialization('Развитие бизнеса');
        $this->addSpecialization('Системный администратор');
        $this->addSpecialization('Системы управления предприятием (ERP)');
        $this->addSpecialization('Сотовые, Беспроводные технологии');
        $this->addSpecialization('Стартапы');
        $this->addSpecialization('Телекоммуникации');
        $this->addSpecialization('Тестирование');
        $this->addSpecialization('Технический писатель');
        $this->addSpecialization('Управление проектами');
        $this->addSpecialization('Электронная коммерция');
        $this->addSpecialization('CRM системы');
        $this->addSpecialization('Web инженер');
        $this->addSpecialization('Web мастер');
        
    }
    
    public function addSpecialization($nameSpecialization) {
        $specialization = Specialization::getNewSpecialization($nameSpecialization);
        $specialization->save();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%specialization}}');
    }
}
