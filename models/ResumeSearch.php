<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $gender = $params['gender'];
        $query = Resume::find()
        ->innerJoin('user', '"resume"."user_id" = "user"."id"');
        $orderType = $params['orderType'] == 'DESC'? SORT_DESC:SORT_ASC;
        if(array_key_exists('cityId', $params)) {
            $cityId = $params['cityId'];
            if($cityId != 0){
                $query->innerJoin('city', '"user"."city_id" = ' . $cityId);
            }
        }
        
        $where = '';
        if(array_key_exists('idSpecialization', $params)) {
            $idSpecialization = $params['idSpecialization'];
            if($idSpecialization != 0){
                $query->innerJoin('place_of_work', '"resume"."id" = ' . '"place_of_work"."resume_id"');
                $where = '"place_of_work"."specialization_id" = \''.$idSpecialization.'\'';
            }
        }
        
        $hasParentheses = false;
        if(array_key_exists('listTypeEmployments', $params)) {
            $listTypeEmployments = $params['listTypeEmployments'];
            if($where != '') {
                $where .= ' AND (';
                $hasParentheses = true;
            }
            $query->innerJoin('resume_type_employment', '"resume_type_employment"."resume_id" = ' . '"resume"."id"');

            for($i=0; $i<count($listTypeEmployments); $i++) {
                if($i>=1 && $i<count($listTypeEmployments)) {
                    $or = ' OR ';
                }
                else {
                    $or = ' ';
                }
                $where .= $or.'"resume_type_employment"."type_employment_id" = \''.$listTypeEmployments[$i].'\''; 
            }
            if($hasParentheses == true){
                $where .= ') ';
            }
        }
//         print_r($where);
//         exit();
        
        if($gender != 'all') {
            if($where != '') {
                $where .= ' AND ';
            } 
            $where .= '"user"."gender" = \''.$gender.'\''; 
        }
        
        
        $query->where($where);
       
        
        $query->orderBy([$params['orderTable'] => $orderType]);
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
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
}
