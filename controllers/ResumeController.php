<?php

namespace app\controllers;

use DateTime;
use Yii;
use app\models\MenuHeader;
use app\models\Resume;
use app\models\ResumeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use phpDocumentor\Reflection\Types\Array_;

/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    /**
     * Returns the sort parameters.
     * 
     * @return array
     */
    private function getSortParams(){
        $orderType = 'DESC';
        $orderTable = 'date_update';
        $typeSort = 'По новизне';
        if(array_key_exists('type_sort', Yii::$app->request->queryParams)){
            if(Yii::$app->request->queryParams['type_sort'] == 'inc-salary') {
                $orderType = 'ASC';
                $orderTable = 'salary';
                $typeSort = 'По возрастанию зарплаты';
            } else if (Yii::$app->request->queryParams['type_sort'] == 'desc-salary') {
                $orderType = 'DESC';
                $orderTable = 'salary';
                $typeSort = 'По убыванию зарплаты';
            }
        }
        $sortParams = ['orderType' => $orderType, 'orderTable' => $orderTable, 'typeSort' => $typeSort];
        return $sortParams;
    }
    
    /**
     * Returns gender;
     * 
     * @return string
     */
    private function getGender() {
        $gender = 'all';
        if (array_key_exists('gender', Yii::$app->request->queryParams)) {
            if(Yii::$app->request->queryParams['gender'] == 'male') {
                $gender = 'male';
            } else if (Yii::$app->request->queryParams['gender'] == 'female') {
                $gender = 'female';
            }
        }
        return $gender;
    }
    
    /**
     * Returns cities data.
     * 
     * @return array
     */
    private function getCitiesData() {
        $cityIdSelect = '0';
        if(array_key_exists('city', Yii::$app->request->queryParams)){
            $cityIdSelect = Yii::$app->request->queryParams['city'];
        }
        
        $command = Yii::$app->db->createCommand('SELECT * FROM "city"');
        $dataCities = $command->queryAll();
        $dataCitiesFirst = array(0 => ['id' => 0, 'name' => 'Все']);
        $dataCities = array_merge($dataCitiesFirst, $dataCities);
        $cityName = $dataCities[$cityIdSelect]['name'];
        $cityParams = ['cityIdSelect' => $cityIdSelect, 'dataCities' => $dataCities, 'cityNameSelect' => $cityName];
        return $cityParams;
    }
    
    /**
     * Returns specialization.
     * 
     * @return array
     */
    private function getSpecializationsData():array {
        $specializationIdSelect = '0';
        if(array_key_exists('specialization', Yii::$app->request->queryParams)){
            $specializationIdSelect = Yii::$app->request->queryParams['specialization'];
        }
        
        $command = Yii::$app->db->createCommand('SELECT * FROM "specialization"');
        $arraySpecializationsAll = $command->queryAll();
        
        $arraySpecializationFirst = array(0 => ['id' => 0, 'name' => 'Любая']);
        $arraySpecializations = array_merge($arraySpecializationFirst, $arraySpecializationsAll);
        $selectName = $arraySpecializations[$specializationIdSelect]['name'];
        $dataSpecializations = ['specializations' => $arraySpecializations, 'selectId' => $specializationIdSelect, 
            'selectName' => $selectName];
        
        return $dataSpecializations;
    }
    
    /**
     *  Returns data about type employments.
     *  
     * @return array
     */
    private function getTypeEmploymentsData():array {
        $command = Yii::$app->db->createCommand('SELECT * FROM "type_employment"');
        $typeEmployments = $command->queryAll();
        return $typeEmployments;
    }

    /**
     * Returns data about schedules.
     * 
     * @return array
     */
    private function getSchedulesData():array {
        $command = Yii::$app->db->createCommand('SELECT * FROM "type_employment"');
        $schedules = $command->queryAll();
        return $schedules;
    }
    
    /**
     * Returns active data provider whith values.
     * 
     * @param array $sortData
     * @param array $cityData
     * @param string $gender
     * @return ActiveDataProvider
     */
    private function getDataProvider(array $sortData, array $cityData, string $gender, int $idSpecialization):ActiveDataProvider {
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['orderTable']        = $sortData['orderTable'];
        $queryParams['orderType']         = $sortData['orderType'];
        $queryParams['cityId']            = $cityData['cityIdSelect'];
        $queryParams['idSpecialization']  = $idSpecialization;
        $queryParams['gender']            = $gender;
        
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->search($queryParams);
        
        return $dataProvider;
    }
    
    /**
     * Lists all Resume models.
     * 
     * @return mixed
     */
    public function actionIndex()
    {
        $sortData   = $this->getSortParams();
        $cityData   = $this->getCitiesData();
        $gender     = $this->getGender();
        $dataSpecializations    = $this->getSpecializationsData();
      
        $dataProvider           = $this->getDataProvider($sortData, $cityData, $gender, $dataSpecializations['selectId']);
        //filling in resume data
        $resumeModels = array();
        for ($i=0; $i < count($dataProvider->models); $i++) {
            $resume=$dataProvider->models[$i];
            $user = $this->getUser($dataProvider->models[$i]['user_id']);
            $resumeModels[$i]['city']               = $this->getCity($user['id']);
            $resumeModels[$i]['age']                = $this->getFormatAge($user['date_birth']);
            $resumeModels[$i]['infoAboutLastWork']  = $this->getInfoAboutLastPlaceOfWork($resume['id']);
            $resumeModels[$i]['experience']         = $this->getExperience($resume['id']);
            $resumeModels[$i]['dateUpdate']         = $this->getDataUpdate($resume);
            $resumeModels[$i]['photo']              = $resume->photo;
            $resumeModels[$i]['name']               = $resume->name;
            $resumeModels[$i]['salary']             = $resume->salary;
        }
        
        
        $typeEmployments        = $this->getTypeEmploymentsData();
        $schedules              = $this->getSchedulesData();
        
        SiteController::activateMenuItem(MenuHeader::LIST_RESUME);
        return $this->render('index', [
            'resumeModels'            => $resumeModels,
            'typeSort'                => $sortData['typeSort'],
            'gender'                  => $gender,
            'dataCities'              => $cityData['dataCities'],
            'cityIdSelect'            => $cityData['cityIdSelect'],
            'cityNameSelect'          => $cityData['cityNameSelect'],
            'dataSpecializations'     => $dataSpecializations['specializations'],
            'specializationIdSelect'  => $dataSpecializations['selectId'],
            'typeEmployments'         => $typeEmployments,
            'schedules'               => $schedules
        ]);
    }

    /**
     * Displays a single Resume model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
//         return $this->render('view', [
//             'model' => $this->findModel($id),
//         ]);
        return $this->render('view');
    }
    
    /**
     * Displays a list resumes for one user.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMyResumes()
    {
        //         return $this->render('view', [
        //             'model' => $this->findModel($id),
        //         ]);
        return $this->render('myResumes');
    }

    /**
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Resume();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Resume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
//         $model = $this->findModel($id);

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->id]);
//         }

//         return $this->render('update', [
//             'model' => $model,
//         ]);

        return $this->render('update');
    }

    /**
     * Deletes an existing Resume model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Returns the user of this resume.
     * 
     * @param int $idUser
     * @return array
     */ 
    private function getUser(int $idUser): array {
        $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE id=:user_id');
        $command->bindValue(':user_id', $idUser);
        $user = $command->queryOne();
        return $user;
    }
    
    /**
     * Returns the city of user.
     *
     * @param int $idUser
     * @return string
     */
    private function getCity(int $idUser): string {
        $command = Yii::$app->db->createCommand('SELECT "name" FROM "city" WHERE id=:user_id');
        $command->bindValue(':user_id', $idUser);
        $city = $command->queryOne();
        $nameCity = $city['name'];
        return $nameCity;
    }
    
    /**
     * Returns formatted age
     * 
     * @param string $dateBirthString
     * @return string
     */
    private function getFormatAge(string $dateBirthString): string {
        $dateNow = new DateTime(date('Y-m-d'));
        $dateBirth = new DateTime($dateBirthString);
        $year = $dateNow->diff($dateBirth);
        $stringYear = strval($year->y);
        $lastFigureYear = $stringYear[count(str_split($stringYear))-1];
        if ($lastFigureYear == "1") {
            $age = $year->y . " год";
        } else if ($lastFigureYear == "2" || $lastFigureYear == "3" || $lastFigureYear == "4") {
            $age = $year->y . " года";
        } else {
            $age = $year->y . " лет";
        }
       return $age;
    }
    
    /**
     * Returns the info about last place of work.
     * 
     * @param string $resumeId
     * @return string
     */
    private function getInfoAboutLastPlaceOfWork(string $resumeId): string {
        $command = Yii::$app->db->createCommand('SELECT * FROM "place_of_work" WHERE resume_id=:resume_id ORDER BY date_end DESC');
        $command->bindValue(':resume_id', $resumeId);
        $allPlacesOfWork = $command->queryAll();
        $lastPlaceOfWork = $allPlacesOfWork[0];
        $dateStartWork = $lastPlaceOfWork['date_start'];
        $dateFinishWork = $lastPlaceOfWork['date_end'];
        //list of month
        $monthAndYearStart = $this->getFormatDate($dateStartWork); 
        $monthAndYearFinish = $this->getFormatDate($dateFinishWork); 
//          echo $month;
//          exit;
        
        $infoAboutLastWork = $lastPlaceOfWork['position']." в ".$lastPlaceOfWork['name_organization'].
        ", ".$monthAndYearStart.' — по '." ".$monthAndYearFinish;
        return $infoAboutLastWork;
    }
    
    /**
     * Returns experience.
     * 
     * @param string $resumeId
     * @return string
     */
    private function getExperience(string $resumeId): string {
        $command = Yii::$app->db->createCommand('SELECT * FROM "place_of_work" WHERE resume_id=:resume_id');
        $command->bindValue(':resume_id', $resumeId);
        $placesOfWork = $command->queryAll();
        $days = 0;
        for ($i=0; $i < count($placesOfWork); $i++) {
            $dateStartWork = new DateTime($placesOfWork[$i]['date_start']);
            $dateFinishWork = new DateTime($placesOfWork[$i]['date_end']);
            $interval = $dateFinishWork->diff($dateStartWork);
            $days += $interval->y*365 + $interval->m*30 + $interval->d;
        }
        $countExperience = $this->countExperience($days);
        return $countExperience;
    }
    
    /**
     * Counts experience.
     * 
     * @param int $days
     * @return string
     */
    private function countExperience(int $days):string {
        $countExperience='Опыт работы ';
        if($days >= 365) {
            $year = intdiv($days, 365);
            $days -= $year * 365;
            
            $stringYear = strval($year);
            $lastFigureYear = $stringYear[count(str_split($stringYear))-1];
            if ($lastFigureYear == "1") {
                $yearsExperience = $year . " год";
            } else if ($lastFigureYear == "2" || $lastFigureYear == "3" || $lastFigureYear == "4") {
                $yearsExperience = $year . " года";
            } else {
                $yearsExperience = $year . " лет";
            }
            $countExperience .= $yearsExperience;
        }
        
        if($days >= 30) {
            $months = intdiv($days, 30);
            $stringMonth = strval($months);
            switch ($stringMonth) {
                case '1':
                    $monthsExperience = $months . " месяц";
                    break;
                case '2':
                    $monthsExperience = $months . " месяца";
                    break;
                case '3':
                    $monthsExperience = $months . " месяца";
                    break;
                case '4':
                    $monthsExperience = $months . " месяца";
                    break;
                case '5':
                    $monthsExperience = $months . " месяцев";
                    break;
                case '6':
                    $monthsExperience = $months . " месяцев";
                    break;
                case '7':
                    $monthsExperience = $months . " месяцев";
                    break;
                case '8':
                    $monthsExperience = $months . " месяцев";
                    break;
                case '9':
                    $monthsExperience = $months . " месяцев";
                    break;
                case '10':
                    $monthsExperience = $months . " месяцев";
                    break;
                case '11':
                    $monthsExperience = $months . " месяцев";
                    break;
                case '12':
                    $monthsExperience = $months . " месяцев";
                    break;
            }
            $countExperience .= " ".$monthsExperience;
        }
        
        return $countExperience;
    }

    /**
     * Returns formated date.
     * 
     * @param string $dateString
     * @return string
     */
    private function getFormatDate(string $dateString): string {
        if ($dateString == '') {
            $monthAndYear = "настоящее время";
        } else {
            $monthsList = array(
                "01" => "Январь",
                "02" => "Февраль",
                "03" => "Март",
                "04" => "Апрель",
                "05" => "Май",
                "06" => "Июнь",
                "07" => "Июль",
                "08" => "Август",
                "09" => "Сентябрь",
                "10" => "Октябрь",
                "11" => "Ноябрь",
                "12" => "Декабрь"
            );
            $date = new DateTime($dateString);
            $month = $monthsList[$date->format('m')];
            $monthAndYear = $month . " " . $date->format('Y');
            return $monthAndYear;
        }
    }

    /**
     * This method used for dataUpdate function.
     * Returns formated date.
     *
     * @param string $dateString
     * @return string
     */
    private function getFormatDateUpdate(string $dateString): string
    {
        $monthsList = array(
            "01" => "января",
            "02" => "февраля",
            "03" => "марта",
            "04" => "апреля",
            "05" => "мая",
            "06" => "июня",
            "07" => "июля",
            "08" => "августа",
            "09" => "сентября",
            "10" => "октября",
            "11" => "ноября",
            "12" => "декабря"
            );
            $date = new DateTime($dateString);
            $month = $monthsList[$date->format('m')];
            $monthAndYear = $month . " " . $date->format('Y');
            return $monthAndYear;
        
    }
    
    /**
     * Returns data update.
     * 
     * @param array $resume
     * @return string
     */
    private function getDataUpdate(Resume $resume): string {
        $monthAndYear = $this->getFormatDateUpdate($resume->date_update);
        $dayUpdate = new DateTime($resume['date_update']);
        $formatStringDataUpdate = $dayUpdate->format('d').' '.$monthAndYear.' в '.$dayUpdate->format('H:i');
        return $formatStringDataUpdate;
    }
    
}
