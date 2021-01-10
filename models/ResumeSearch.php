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
    
    private function getCityId(array $queryParams, array $params): array{
        if(array_key_exists('cityId', $params)) {
            $cityId = $params['cityId'];
            if($cityId != 0){
                $queryParams['join'][] = '';
                $queryWhere = '"user"."city_id" = '.$cityId. ' ';
                $queryParams['where'][] = $queryWhere;
            }
        }
        return $queryParams;
    }

    private function getSpecializationId(array $queryParams, array $params): array{
        if(array_key_exists('idSpecialization', $params)) {
            $idSpecialization = $params['idSpecialization'];
            if($idSpecialization != 0){
                $queryParams['join'][] = ' INNER JOIN place_of_work ON "resume"."id" = "place_of_work"."resume_id" ';
                $queryWhere = ' "place_of_work"."specialization_id" = '.$idSpecialization. ' ';
                $queryParams['where'][] = $queryWhere;
            }
        }
        
        return $queryParams;
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
    
    private function serchFullText(string $stringFullTextSerch): array{
        //    (Кемерово | Красноярск) | 4    "city"."name" || ' ' || 
        $strQuery = <<<EOT
                    WITH ts_city AS (
                    SELECT "resume"."id" as "resume_id", 
                        "resume"."photo", 
                        "resume"."name" as "resume_name", "resume"."salary",
                        "resume"."date_update" as "date_update",
                        "user"."id" as "user_id",
                        "user"."date_birth" as "date_birth",
                        "city"."name" as "city_name", 
                        ts_rank(to_tsvector("resume"."name" || ' ' || "city"."name"), to_tsquery(:fullTextSerch)) as "ts" 
                    FROM "resume" 
                    INNER JOIN "user" 
                        ON "resume"."user_id"="user"."id"
                    INNER JOIN "city" 
                        ON "user"."city_id"="city"."id")
                    
                    SELECT distinct *
                    FROM ts_city
                    WHERE "ts" > 0
                    ORDER BY "ts" DESC;
                    EOT;
       // ORDER BY "ts" DESC;
        $command = Yii::$app->db->createCommand($strQuery);
        $command->bindValue(':fullTextSerch', $stringFullTextSerch);
        $resultQuery = $command->queryAll();
        
//         var_dump( $resultQuery);
//         exit();

//         var_dump( $query);
//         exit();
            
        return $resultQuery;
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
    
    private function serchQuery(array $params) {
        $strQuery = <<<EOT
                    SELECT distinct "resume"."id" as "resume_id",
                        "resume"."photo",
                        "resume"."name" as "resume_name", "resume"."salary",
                        "resume"."date_update" as "date_update",
                        "user"."id" as "user_id",
                        "user"."date_birth" as "date_birth",
                        "city"."name" as "city_name"
                    FROM "resume"
                    INNER JOIN "user"
                        ON "resume"."user_id"="user"."id"
                    INNER JOIN "city"
                        ON "user"."city_id"="city"."id"
                    EOT;
        
        $queryWhereParams = [];
        $queryWhereParams = $this->getCityId($queryWhereParams, $params);
        $queryWhereParams = $this->getSpecializationId($queryWhereParams, $params);
//         var_dump( $queryWhereParams);
//         exit();
        if(array_key_exists('join', $queryWhereParams)) {
            if(count($queryWhereParams['join']) > 0) {
                //$strQuery.= 'INNER JOIN ';
                for($i=0; $i<count($queryWhereParams['join']); $i++) {
                    $strQuery.=$queryWhereParams['join'][$i];
                }
            }
        }
        
        if(array_key_exists('where', $queryWhereParams)) {
            if(count($queryWhereParams['where']) > 0) {
                $strQuery.= 'WHERE ';
                $strQuery.=$queryWhereParams['where'][0];
                for($i=1; $i<count($queryWhereParams['where']); $i++) {
                    $strQuery .= ' AND ';
                    $strQuery .= $queryWhereParams['where'][$i];
                }
            }
        }
       
        
//         var_dump($strQuery);
//         exit();
        
        $orderTable = $params['orderTable'];
        $orderType = $params['orderType'] == 'DESC'? "DESC":"ASC";
        $order = "ORDER BY $orderTable $orderType;";
        $strQuery.=$order;
//                  echo( $strQuery);
//         exit();
        $command = Yii::$app->db->createCommand($strQuery);
        $resultQuery = $command->queryAll();
        
        //         var_dump( $resultQuery);
        //         exit();
        
        return $resultQuery;
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
       
        $query = Resume::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
//             uncomment the following line if you do not want to return any records when validation fails
//             $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'salary' => $this->salary,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['ilike', 'photo', $this->photo])
            ->andFilterWhere(['ilike', 'about_me', $this->about_me]);

        return $dataProvider;
    }
    
    /**
     * Returns models Resume
     * 
     * @param array $params
     * @return array
     */
    public function serchModels(array $params): array {
        
        $stringFullTextSerch = $query = $this->getStringFullTextSerch($params);
        if($stringFullTextSerch != '') {
            $models = $this->serchFullText($stringFullTextSerch);
            return $models;
        }
        else {
            $models = $this->serchQuery($params);
            return $models;
            
            $query = Resume::find()
            ->innerJoin('user', '"resume"."user_id" = "user"."id"');
            $orderType = $params['orderType'] == 'DESC'? SORT_DESC:SORT_ASC;
            
           // $query = $this->getCityId($query, $params);
//            $query = $this->getSpecializationId($query, $params);
            
            $query = $this->getListTypeEmployments($query, $params);
            $query = $this->getListSchedules($query, $params);
            $query = $this->getGender($query, $params);
            $query = $this->getSalary($query, $params);
            
            $query->orderBy([$params['orderTable'] => $orderType]);
            
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
            
//             $this->load($params);
            
//             if (!$this->validate()) {
//                 // uncomment the following line if you do not want to return any records when validation fails
//                 // $query->where('0=1');
//                 return $dataProvider;
//             }
            
            return $dataProvider->models;
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
        
       
        
        //         // grid filtering conditions
        //         $query->andFilterWhere([
        //             'id' => $this->id,
        //             'salary' => $this->salary,
        //             'user_id' => $this->user_id,
        //         ]);
            
        //         $query->andFilterWhere(['ilike', 'photo', $this->photo])
        //             ->andFilterWhere(['ilike', 'about_me', $this->about_me]);
        
        
    }
}
