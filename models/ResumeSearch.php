<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use app\models\Resume;
use Yii;

/**
 * ResumeSearch represents the model behind the search form of `app\models\Resume`.
 */
class ResumeSearch extends Resume
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'salary', 'user_id'], 'integer'],
            [['photo', 'about_me'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    private function getCityId(ActiveQuery $query, array $params): ActiveQuery{
        if(array_key_exists('cityId', $params)) {
            $cityId = $params['cityId'];
            if($cityId != 0){
                $query->innerJoin('city', '"user"."city_id" = ' . $cityId);
            }
        }
        return $query;
    }

    private function getSpecializationId(ActiveQuery $query, array $params): ActiveQuery{
        if(array_key_exists('idSpecialization', $params)) {
            $idSpecialization = $params['idSpecialization'];
            if($idSpecialization != 0){
                $query->innerJoin('place_of_work', '"resume"."id" = ' . '"place_of_work"."resume_id"');
                $query->where['"place_of_work"."specialization_id"'] = [$idSpecialization];
            }
        }
        
        return $query;
    }
    
//     private function getListExperients(ActiveQuery $query, array $params): ActiveQuery{
//         if(array_key_exists('experients', $params)) {
//             $listTypeEmployments = $params['experients'];
//             if(!empty($listTypeEmployments)) {
//                 $query->innerJoin('resume_type_employment', '"resume_type_employment"."resume_id" = ' . '"resume"."id"');
//                 $query->where['"resume_type_employment"."type_employment_id"'] = $listTypeEmployments;
//             }
//         }
//         return $query;
//     }
    
    private function getListTypeEmployments(ActiveQuery $query, array $params): ActiveQuery{
        if(array_key_exists('listTypeEmployments', $params)) {
            $listTypeEmployments = $params['listTypeEmployments'];
            if(!empty($listTypeEmployments)) {
                $query->innerJoin('resume_type_employment', '"resume_type_employment"."resume_id" = ' . '"resume"."id"');
                $query->where['"resume_type_employment"."type_employment_id"'] = $listTypeEmployments;
            }
        }
        return $query;
    }
    
    private function getListSchedules(ActiveQuery $query, array $params): ActiveQuery{
        if(array_key_exists('listCheckBoxSchedules', $params)) {
            $listSchedule = $params['listCheckBoxSchedules'];
            if(!empty($listSchedule)) {
                $query->innerJoin('resume_schedule', '"resume_schedule"."resume_id" = ' . '"resume"."id"');
                $query->where['"resume_schedule"."schedule_id"'] = $listSchedule;
            }
        }
        return $query;
    }
    
    private function getSalary(ActiveQuery $query, array $params): ActiveQuery{
        if(array_key_exists('salary', $params)) {
            $salary = $params['salary'];
            if($salary != 0) {
                $query->where['"resume"."salary"'] = $salary;
            }
        }
        return $query;
    }
    
    private function getGender(ActiveQuery $query, array $params): ActiveQuery{
        if(array_key_exists('gender', $params)) {
            $gender = $params['gender'];
            if($gender != 'all') {
                $query->where['"user"."gender"'] = [$gender];
            }
        }
        return $query;
    }
    
    private function serchFullText(ActiveQuery $query, string $stringFullTextSerch): ActiveQuery{
        //    (Кемерово | Красноярск) | 4    "city"."name" || ' ' || 
        $strQuery = <<<EOT
                    WITH ts_city AS (
                    SELECT "resume"."id", ts_rank(to_tsvector("resume"."name" || ' ' || "city"."name"), to_tsquery(:fullTextSerch)) as "ts" 
                    FROM "resume" 
                    INNER JOIN "user" 
                    ON "user"."id"="resume"."user_id"   
                    INNER JOIN "city" 
                    ON "city"."id"="user"."city_id")
                    
                    SELECT *
                    FROM ts_city
                    WHERE "ts">0
                    ORDER BY "ts" DESC;
                    EOT;
        $command = Yii::$app->db->createCommand($strQuery);
        $command->bindValue(':fullTextSerch', $stringFullTextSerch);
        $resultQuery = $command->queryAll();
        $mas=[];
        foreach ($resultQuery as $result) {
            $mas[] = $result['id'];
        }
        
        //$query->innerJoin('user', '"user"."city_id" = "city"."id"');
        
//         $query->innerJoin('user', '"resume"."user_id" = "user"."id"');
//         $query->innerJoin('city', '"city"."id" = "user"."city_id"');
        $query->where['"resume"."id"'] = $mas;
        
//         var_dump( $mas);
//         exit();
            
        return $query;
    }
    
    private function getStringFullTextSerch(array $params): string{
        $fullTextSerch = '';
        if(array_key_exists('fullTextSerch', $params)) {
            $fullTextSerch = $params['fullTextSerch'];
            $arrayFullTextSerch = explode(" ", $fullTextSerch);
            $fullTextSerch = join("|", $arrayFullTextSerch);
            
//             var_dump( $fullTextSerch);
//             exit();
        }
        return $fullTextSerch;
    }
    
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
       

        
        
        $stringFullTextSerch = $query = $this->getStringFullTextSerch($params);
        if($stringFullTextSerch != '') {
            $query = Resume::find();
            $query = $this->serchFullText($query, $stringFullTextSerch);
        }
        else {
            $query = Resume::find()
            ->innerJoin('user', '"resume"."user_id" = "user"."id"');
            $orderType = $params['orderType'] == 'DESC'? SORT_DESC:SORT_ASC;
            
            $query = $this->getCityId($query, $params);
            $query = $this->getSpecializationId($query, $params);
    
            $query = $this->getListTypeEmployments($query, $params);
            $query = $this->getListSchedules($query, $params);
            $query = $this->getGender($query, $params);
            $query = $this->getSalary($query, $params);
            
            $query->orderBy([$params['orderTable'] => $orderType]);
        }
        
        
//         var_dump($query);
//         exit();

        // $query->where(['id' => [1, 2, 3], 'status' => 2] );
       //  $query->where['AAA'] = '2' ;
       //  print_r($query->where);
//         echo '<br>';
//         $query->where['resume_id']= ['12345', '6', '7'];
       // $query->where['resume_id']= ['12345', '6', '7'];
       
//         var_dump($query->where);
//         exit();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

//         // grid filtering conditions
//         $query->andFilterWhere([
//             'id' => $this->id,
//             'salary' => $this->salary,
//             'user_id' => $this->user_id,
//         ]);

//         $query->andFilterWhere(['ilike', 'photo', $this->photo])
//             ->andFilterWhere(['ilike', 'about_me', $this->about_me]);

        return $dataProvider;
    }
}
