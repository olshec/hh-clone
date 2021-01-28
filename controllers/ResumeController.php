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
use yii\helpers\FileHelper;
use app\models\PlaceOfWork;
use app\models\TypeEmployment;
use app\models\Schedule;
use app\models\User;
use app\models\City;
use app\models\ResumeSchedule;

use yii\web\UploadedFile;
use app\models\Specialization;
use app\models\ResumeTypeEmployment;
use yii\helpers\VarDumper;


/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
{
    
    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if ($action->id == 'upload') {
            $this->enableCsrfValidation = false;
        }
        
        return parent::beforeAction($action);
    }
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
//                 'actions' => [
//                     'delete' => ['POST'],
//                 ],
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
    private function getSpecializations():array {
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
    * @param array $listCheckBoxTypeEmployments
    * @return array
    */
    private function getTypeEmploymentsData(array $listCheckBoxTypeEmployments):array {
        $typeEmployments = (new TypeEmployment())->getAllTypeEmployment();
        for($i=0; $i<count($typeEmployments); $i++) {
            $typeEmployments[$i]['checked'] = false;
        }
        for($i=0; $i<count($listCheckBoxTypeEmployments); $i++) {
            $indexChecked = $listCheckBoxTypeEmployments[$i]-1;
            $typeEmployments[$indexChecked]['checked'] = true;
        }
        return $typeEmployments;
    }

   /**
    * Returns data about schedules.
    * 
    * @param array $listCheckBoxSchedules
    * @return array
    */
    private function getSchedulesList(array $listCheckBoxSchedules):array {
        $schedules = (new Schedule())->getAllSchedules();
        
        for($i=0; $i<count($schedules); $i++) {
            $schedules[$i]['checked'] = false;
        }
        for($i=0; $i<count($listCheckBoxSchedules); $i++) {
            $indexChecked = $listCheckBoxSchedules[$i]-1;
            $schedules[$indexChecked]['checked'] = true;
        }
        return $schedules;
    }
    
    /**
     * Returns data about experience.
     *
     * @param array $listCheckBoxSchedules
     * @return array
     */
    private function getExperienceList():array {
        $listCheckBoxExperience = $this->getListCheckBoxExperience();
        $experience = [];
        $experience[0]['name'] = 'Без опыта';
        $experience[1]['name'] = 'От 1 года до 3 лет';
        $experience[2]['name'] = 'От 3 лет до 6 лет';
        $experience[3]['name'] = 'Более 6 лет';
        
        for($i=0; $i<count($experience); $i++) {
            $experience[$i]['id'] = $i+1;
            $experience[$i]['checked'] = false;
        }
        for($i=0; $i<count($listCheckBoxExperience); $i++) {
            $indexChecked = $listCheckBoxExperience[$i]-1;
            $experience[$indexChecked]['checked'] = true;
        }
        return $experience;
    }
    
    private function getListTypeEmployments() {
        $employments = [];
        if (array_key_exists('type_employment', Yii::$app->request->queryParams)) {
            $employments = Yii::$app->request->queryParams['type_employment'];
        }
        return $employments;
    }
    
    private function getListTypeSchedules() {
        $schedules = [];
        if (array_key_exists('type_schedule', Yii::$app->request->queryParams)) {
            $schedules = Yii::$app->request->queryParams['type_schedule'];
        }
        return $schedules;
    }
    
    private function getListCheckBoxExperience() {
        $experience= [];
        if (array_key_exists('experience', Yii::$app->request->queryParams)) {
            $experience = Yii::$app->request->queryParams['experience'];
        }
        return $experience;
    }

    private function getSalary() {
        $salary = '';
        if (array_key_exists('salary', Yii::$app->request->queryParams)) {
            $salary = Yii::$app->request->queryParams['salary'];
        }
        if (!is_numeric($salary)){
            return 0;
        } else if ($salary < 0) {
            return 0;
        }
        return $salary;
    }
    
    private function getFullText() {
        $text = '';
        if (array_key_exists('serchText', Yii::$app->request->queryParams)) {
            $text = Yii::$app->request->queryParams['serchText'];
        }
        return $text;
    }
    
    private function getAgeFrom() {
        $ageFrom = '';
        if (array_key_exists('ageFrom', Yii::$app->request->queryParams)) {
            $ageFrom = Yii::$app->request->queryParams['ageFrom'];
        }
        if (!is_numeric($ageFrom)){
            return 0;
        } else if ($ageFrom < 0) {
            return 0;
        }
        return $ageFrom;
    }
    
    private function getAgeUp() {
        $ageUp = '';
        if (array_key_exists('ageUp', Yii::$app->request->queryParams)) {
            $ageUp = Yii::$app->request->queryParams['ageUp'];
        }
        if (!is_numeric($ageUp)){
            return 0;
        } else if ($ageUp < 0) {
            return 0;
        } 
        return $ageUp;
    }
    
    /**
     * Returns active data provider whith values.
     *  
     * @param array $sortData
     * @param array $cityData
     * @param string $gender
     * @param int $idSpecialization
     * @param array $listTypeEmployments
     * @param array $listCheckBoxSchedules
     * @param int $salary
     * @return array
     */
    private function getListAllResumes(array $sortData, array $cityData, string $gender, int $idSpecialization, 
        array $listTypeEmployments, array $listCheckBoxSchedules, int $salary, string $fullTextSerch):array {
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['orderTable']              = $sortData['orderTable'];
        $queryParams['orderType']               = $sortData['orderType'];
        $queryParams['cityId']                  = $cityData['cityIdSelect'];
        $queryParams['gender']                  = $gender;
        $queryParams['idSpecialization']        = $idSpecialization;
        $queryParams['listTypeEmployments']     = $listTypeEmployments;
        $queryParams['listCheckBoxSchedules']   = $listCheckBoxSchedules;
        $queryParams['salary']                  = $salary;
        $queryParams['fullTextSerch']           = $fullTextSerch;
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->serchModels($queryParams);
        
        return $dataProvider;
    }
    
    /**
     * Checks experience.
     * 
     * @param int $experienceDays
     * @return bool
     */
    private function checkExperience(int $experienceDays): bool {
        $listCheckBoxExperience = $this->getListCheckBoxExperience();
        if(count($listCheckBoxExperience) == 0){
            return true;
        }
        for($i=0; $i < count($listCheckBoxExperience); $i++){
            $expCase = $listCheckBoxExperience[$i];
            switch ($expCase){
                case 1:
                    if($experienceDays == 0) return true;
                    break;
                case 2:
                    if($experienceDays >= 365 && $experienceDays <= 1095) return true;
                    break;
                case 3:
                    if($experienceDays > 1095 && $experienceDays <= 2190) return true;
                    break;
                case 4:
                    if($experienceDays > 2190) return true;
                    break;
            }
        }
        return false;
    }
    
    private function setPaginizeDataProvider(array $models, int $limit): \app\Util\Paginator{
        
        $numberPage = 0;
        if (array_key_exists('page', Yii::$app->request->queryParams)) {
            $numberPage = Yii::$app->request->queryParams['page'];
        }
        if (!is_numeric($numberPage)){
            $numberPage = 1;
        } else if ($numberPage <= 1) {
            $numberPage = 1;
        } 
        $provider = new \app\Util\Paginator($models, $limit, $numberPage-1);
        return $provider;
    }
    
    private function getAge(string $dateBirthString):int {
        $dateNow = new DateTime(date('Y-m-d'));
        $dateBirth = new DateTime($dateBirthString);
        $age = $dateNow->diff($dateBirth);
        return $age->y;
    }
    
    /**
     * Returns formatted age
     *
     * @param string $dateBirthString
     * @return string
     */
    private function getFormatAge(string $dateBirthString): string {
        $age = $this->getAge($dateBirthString);
        $stringYear = strval($age);
        $lastFigureYear = $stringYear[count(str_split($stringYear))-1];
        if ($lastFigureYear == "1") {
            $formatAge = $age . " год";
        } else if ($lastFigureYear == "2" || $lastFigureYear == "3" || $lastFigureYear == "4") {
            $formatAge = $age . " года";
        } else {
            $formatAge = $age . " лет";
        }
        return $formatAge;
    }
    
    /**
     * Returns the info about last place of work.
     *
     * @param int $resumeId
     * @return string
     */
    private function getInfoAboutLastPlaceOfWork(int $resumeId): string {
        $command = Yii::$app->db->createCommand('SELECT * FROM "place_of_work" WHERE resume_id=:resume_id ORDER BY date_end DESC');
        $command->bindValue(':resume_id', $resumeId);
        $lastPlaceOfWork = $command->queryOne();
        $dateStartWork = $lastPlaceOfWork['date_start'];
        $dateFinishWork = $lastPlaceOfWork['date_end'];
        
        $infoAboutLastWork = 'Нет опыта';
        if($dateStartWork != null && $dateFinishWork != null){
            $monthAndYearStart = $this->getFormatDate($dateStartWork);
            $monthAndYearFinish = $this->getFormatDate($dateFinishWork);
            $infoAboutLastWork = $lastPlaceOfWork['position']." в ".$lastPlaceOfWork['name_organization'].
            ", ".$monthAndYearStart.' — по '." ".$monthAndYearFinish;
        }
        
        return $infoAboutLastWork;
    }
    

    /**
     * Return all days experience.
     *
     * @param int $resumeId
     * @return int
     */
    private function getAllDaysExperience(int $resumeId):int {
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
        return $days;
    }
    
    /**
     * Returns experience.
     *
     * @param string $resumeId
     * @return string
     */
    private function getAllExperience(int $resumeId): string {
        $days = $this->getAllDaysExperience($resumeId);
        $experience = $this->countExperience($days);
        return $experience;
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
            $countDigit = count(str_split($stringYear));
            $lastFigureYear = $stringYear[$countDigit-1];
            if($year == '11'){
                $yearsExperience = "11 лет";
            } else if ($lastFigureYear == "1") {
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
    private function getDataUpdate(string $dateUpdate): string {
        $monthAndYear = $this->getFormatDateUpdate($dateUpdate);
        $dayUpdate = new DateTime($dateUpdate);
        $formatStringDataUpdate = $dayUpdate->format('d').' '.$monthAndYear.' в '.$dayUpdate->format('H:i');
        return $formatStringDataUpdate;
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
        $specializationsData    = $this->getSpecializations();
        $listCheckBoxTypeEmployments = $this->getListTypeEmployments();
        $listCheckBoxSchedules       = $this->getListTypeSchedules();
        $salary                      = $this->getSalary();
        $fullTextSerch               = $this->getFullText();
        
        $listResume = $this->getListAllResumes($sortData, $cityData, $gender, $specializationsData['selectId'], 
            $listCheckBoxTypeEmployments, $listCheckBoxSchedules, $salary, $fullTextSerch);

        //filling resume data
        $ageFrom = $this->getAgeFrom();
        $ageUp   = $this->getAgeUp();
        $resumes = array();
        for ($i=0; $i < count($listResume); $i++) {
            $resumeModel=$listResume[$i];
            $experienceDays = $this->getAllDaysExperience($resumeModel['resume_id']);
            if($this->checkExperience($experienceDays)){
                $userAge = $this->getAge($resumeModel['date_birth']);
                if($userAge >= $ageFrom && ($userAge <= $ageUp || $ageUp == 0)){
                    $resumes[$i]['city']               = $resumeModel['city_name'];
                    $resumes[$i]['age']                = $this->getFormatAge($resumeModel['date_birth']);
                    $resumes[$i]['infoAboutLastWork']  = $this->getInfoAboutLastPlaceOfWork($resumeModel['resume_id']);
                    $resumes[$i]['experience']         = $this->getAllExperience($resumeModel['resume_id']);
                    $resumes[$i]['dateUpdate']         = $this->getDataUpdate($resumeModel['date_update']);
                    $resumes[$i]['photo']              = $resumeModel['path'].'/'.$resumeModel['photo'];
                    $resumes[$i]['name']               = $resumeModel['resume_name'];
                    $resumes[$i]['salary']             = $resumeModel['salary'];
                }
            }
        }
        
        $typeEmployments        = $this->getTypeEmploymentsData($listCheckBoxTypeEmployments);
        $schedules              = $this->getSchedulesList($listCheckBoxSchedules);
        $experience             = $this->getExperienceList();
        $countResumes           = count($resumes);
        //paginator
        $paginator = $this->setPaginizeDataProvider($resumes, 5);
        $stringPagination = $paginator->getPaginationLinks();
        $resumes = $paginator->getModels(); 

        SiteController::activateMenuItem(MenuHeader::LIST_RESUME);
        return $this->render('index', [
            'resumeModels'                    => $resumes,
            'countResumes'                    => $countResumes,
            'typeSort'                        => $sortData['typeSort'],
            'gender'                          => $gender,
            'dataCities'                      => $cityData['dataCities'],
            'cityIdSelect'                    => $cityData['cityIdSelect'],
            'cityNameSelect'                  => $cityData['cityNameSelect'],
            'dataSpecializations'             => $specializationsData['specializations'],
            'specializationIdSelect'          => $specializationsData['selectId'],
            'typeEmployments'                 => $typeEmployments,
            'schedules'                       => $schedules,
            'experience'                      => $experience,
            'salary'                          => $salary,
            'ageFrom'                         => $ageFrom,
            'ageUp'                           => $ageUp,
            'stringPagination'                => $stringPagination
        ]);
    }
    
    private function getInfoAooutDateWork(string $dateStartWork, string $dateFinishWork): string {
        $monthAndYearStart = $this->getFormatDate($dateStartWork);
        $monthAndYearFinish = $this->getFormatDate($dateFinishWork);
        $infoAboutWork = $monthAndYearStart.' — по '." ".$monthAndYearFinish;
        return $infoAboutWork;
    }

    private function getAllPlacesOfWork(int $resumeId): array {
        $command = Yii::$app->db->createCommand('SELECT * FROM "place_of_work" WHERE resume_id=:resume_id');
        $command->bindValue(':resume_id', $resumeId);
        $placesOfWork = $command->queryAll();
        
        $days = 0;
        $experience = [];
        for ($i=0; $i < count($placesOfWork); $i++) {
            $dateStartWork = new DateTime($placesOfWork[$i]['date_start']);
            $dateFinishWork = new DateTime($placesOfWork[$i]['date_end']);
            $interval = $dateFinishWork->diff($dateStartWork);
            $days = $interval->y*365 + $interval->m*30 + $interval->d;
            $experience[$i]['date_experients']      = $this->countExperience($days);
            $experience[$i]['name_organization']    = $placesOfWork[$i]['name_organization'];
            $experience[$i]['position']             = $placesOfWork[$i]['position'];
            $experience[$i]['about']                = $placesOfWork[$i]['about'];
            $experience[$i]['date_work']             = $this->getInfoAooutDateWork($placesOfWork[$i]['date_start'], 
                                                    $placesOfWork[$i]['date_end']);
        }
//         var_dump($experience);
//         exit();
        return $experience;
    }
    
    /**
     * Displays a single Resume model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {

        if (array_key_exists('resume', Yii::$app->request->queryParams)) {
            $resumeID = Yii::$app->request->queryParams['resume'];
            $searchModel = new ResumeSearch();
            $resume = $searchModel->serchResumeById($resumeID);
            $resume['experience_total']   = $this->getAllExperience($resume['resume_id']);
            $resume['age']                = $this->getFormatAge($resume['date_birth']);
            $resume['place_of_work']      = $this->getAllPlacesOfWork($resumeID);
            
            //serch type employment
            $searchModel = new TypeEmployment();
            $typeEmployments = $searchModel->getTypeEmploymentByIdResume($resume['resume_id']);
//             var_dump($typeEmployments);
//             exit();
            $typeEmployment = '';
            if(count($typeEmployments)>=1){
                $typeEmployment .= $typeEmployments[0]['name'];
                for($i=1; $i < count($typeEmployments); $i++) {
                    $temp = explode ( " " , $typeEmployments[$i]['name']);
                    $temp = $temp[0];
                    $typeEmployment .= ', ' . mb_strtolower($temp);
                }
            }
            $resume['type_employment'] = $typeEmployment;
            
            //serch schedule
            $searchModel = new Schedule();
            $schedules = $searchModel->getScheduleByIdResume($resume['resume_id']);
            $schedule = '';
            if(count($schedules)>=1){
                $schedule .= $schedules[0]['name'];
                for($i=1; $i < count($schedules); $i++) {
                    $schedule .= ', ' . mb_strtolower($schedules[$i]['name']);
                }
            }
            $resume['schedule'] = $schedule;
            $resume['photo'] = $resume['path'].'/'.$resume['photo'];
            return $this->render('view', ['resume' => $resume]);
        }  else {
            return $this->redirect('index');
        }
        
        
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
        $searchModel = new ResumeSearch();
        $userId = 4;
        $resumes = $searchModel->serchResumesByIdUser($userId);
        
        
//         var_dump($resumes[0]);
//         exit();
        
        //set experience
        for($i=0; $i < count($resumes); $i++) {
            $resumes[$i]['experience'] = $this->getAllExperience($resumes[$i]['resume_id']);
            $resumes[$i]['datePublication'] = $this->getDataUpdate($resumes[$i]['date_publication']);
        }
       
        return $this->render('myResumes', [
            'resumes' => $resumes,
            'countResumes' => count($resumes),
            'userId' => $userId,
        ]);
    }

    
    public function initFieldForActionCreate(array $errors): array {
        
        if (array_key_exists('user-id', Yii::$app->request->queryParams)) {
            $idUser = Yii::$app->request->queryParams['user-id'];
        } else {
            $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE name=:name AND surname=:surname AND date_birth=:date_birth');
            $command->bindValue(':name', $nameUser= 'Andrey');
            $command->bindValue(':surname', $surname='Rumov');
            $command->bindValue(':date_birth', $dateBirth='1999-08-11');
            $user = $command->queryOne();
            
            if(count($user) > 0){
                $idUser = $user['id'];
            } else {
                $idUser = -1;
                $errors['userStatus'] = 'Пользователь не найден';
            }
        }
        
        $specialization = new Specialization();
        $listSpecialization = $specialization->getAllSpecializations();
        $typeEmployments = (new TypeEmployment())->getAllTypeEmployment();
        $schedules = (new Schedule())->getAllSchedules();
        $user = (new User())->getUserById($idUser);
        $user['date_birth'] = date('d.m.Y', strtotime($user['date_birth']));
        $user['city'] = (new City())->findNameCityById($user['city_id']);
        $result = ['listSpecialization' => $listSpecialization,
            'typeEmployments' => $typeEmployments, 'schedules' => $schedules, 'user' => $user,
            'errors' => $errors,
        ];
        return $result;
    }
    
    /**
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (array_key_exists('user-id', Yii::$app->request->queryParams)) {
            return $this->render('create', $this->initFieldForActionCreate([]));
        } else if(array_key_exists('radio-gender', Yii::$app->request->queryParams)) {

            $photo = Yii::$app->request->queryParams['photo-profile'];
            $surname = Yii::$app->request->queryParams['surname'];
            $nameUser = Yii::$app->request->queryParams['name'];
            $patronymic = Yii::$app->request->queryParams['patronymic'];
            $dateBirth = Yii::$app->request->queryParams['date-birth'];
            $radioGender = Yii::$app->request->queryParams['radio-gender'];
            $city = Yii::$app->request->queryParams['city'];
            $email = Yii::$app->request->queryParams['email'];
            $telephone = Yii::$app->request->queryParams['telephone'];
            
            
            //Career objective
            if (array_key_exists('specialization', Yii::$app->request->queryParams)) {
                $idSpecialization = Yii::$app->request->queryParams['specialization'];
            } else {
                $idSpecialization = '1';
            }
            
            if (array_key_exists('salary', Yii::$app->request->queryParams)) {
                $salary = Yii::$app->request->queryParams['salary'];
                if($salary == '') {
                    $salary = 0;
                }
            } else {
                $salary = 0;
            }
            
            if (array_key_exists('type_employment', Yii::$app->request->queryParams)) {
                $idTtypeEmployment = Yii::$app->request->queryParams['type_employment'];
            } else {
                $idTtypeEmployment =  [];
            }
            
            if (array_key_exists('type_schedule', Yii::$app->request->queryParams)) {
                $schedule = Yii::$app->request->queryParams['type_schedule'];
            } else {
                $schedule =  [];
            }
           
            if($surname == ''){
                $errors['surname'] = 'Поле является обязательным';
            }
            if($nameUser == ''){
                $errors['name'] = 'Поле является обязательным';
            }
            if($patronymic == ''){
                $errors['patronymic'] = 'Поле является обязательным';
            }
            if($dateBirth == ''){
                $errors['date-birth'] = 'Поле является обязательным';
            }
            if($city == ''){
                $errors['city'] = 'Поле является обязательным';
            }
            //experients
            if($email == ''){
                $errors['email'] = 'Поле является обязательным';
            }
            if($telephone == ''){
                $errors['telephone'] = 'Поле является обязательным';
            }
            $aboutMe = Yii::$app->request->queryParams['about-me'];
            
            $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE name=:name AND surname=:surname AND date_birth=:date_birth');
            $command->bindValue(':name', $nameUser= 'Andrey');
            $command->bindValue(':surname', $surname='Rumov');
            $command->bindValue(':date_birth', $dateBirth='1999-08-11');
            $user = $command->queryOne();
            
            
            if(count($user) > 0){
                $idUser = $user['id'];
                
                $dateBirth = date('Y-m-d', strtotime($dateBirth));
                $specialization = new Specialization();
                $nameResume = $specialization->getNameSpecializationById($idSpecialization);
                $hasNameResume = (new ResumeSearch())->hasNameResume($nameResume);
                
                if($hasNameResume){
                    $errors['resumeName'] = 'Резюме с данной специализацией уже зарегистрировано.
                                                Вы можете создать резюме с другой специализацией или
                                                отредактировать существующее.';
                    return $this->render('create', $this->initFieldForActionCreate($errors));
                }
                
                //get job experients 
                $dateUpdate =  date("Y-m-d h:i:s");
                $numberViews = 0;
                $datePublication = $dateUpdate;
                
                $command = Yii::$app->db->createCommand('SELECT path, photo FROM "resume" WHERE user_id=:user_id');
                $command->bindValue(':user_id', $idUser);
                $resume = $command->queryOne();
                $path = $resume['path'];
                
                //'Andrey_Rumov_2001-08-11_576890435'
                $resume = Resume::getNewResume($nameResume, $salary, $aboutMe, $path, $photo, $dateUpdate, $numberViews, $datePublication, $idUser);
                $resume->save();
                
                foreach($idTtypeEmployment as $idTE){
                    $resumeTypeEmployment = ResumeTypeEmployment::getNewResumeTypeEmployment($resume['id'], $idTE);
                    $resumeTypeEmployment->save();
                }
                
                foreach($schedule as $sch){
                    $resumeSchedule = ResumeSchedule::getNewResumeSchedule($resume['id'], $sch);
                    $resumeSchedule->save();
                }
                
                $experienceRadioButton = Yii::$app->request->queryParams['radio-experience'];

                if($experienceRadioButton[0] == 'yes'){
                    $jobBeginMonth = Yii::$app->request->queryParams['job-begin-month'];
                    $jobBeginYear = Yii::$app->request->queryParams['job-begin-year'];
                    
                    
                    $jobEndMonth = Yii::$app->request->queryParams['job-end-month'];
                    $jobEndYear = Yii::$app->request->queryParams['job-end-year'];
                    
                    if (array_key_exists('job-until-now', Yii::$app->request->queryParams)) {
                        $jobUntilNow = Yii::$app->request->queryParams['job-until-now'];
                    } else {
                        $jobUntilNow = 'off';
                    }
                    
                    
                    $organisation = Yii::$app->request->queryParams['organisation'];
                    $position = Yii::$app->request->queryParams['position'];
                    $aboutExperient = Yii::$app->request->queryParams['about-experient'];
                    
                    for($i=0; $i < count($jobBeginMonth); $i++) {
                        $date_start =  $jobBeginYear[$i].'-'.$jobBeginMonth[$i].'-'.'01';
                        $date_end =  $jobEndYear[$i].'-'.$jobEndMonth[$i].'-'.'01';
                        $placeOfWork = PlaceOfWork::getNewPlaceOfWork($organisation[$i], $position[$i], $date_start,
                            $date_end, $aboutExperient[$i], $resume['id'], $idSpecialization);
                        $placeOfWork->save();
                    }
                }
                
                $command = Yii::$app->db->createCommand('SELECT * FROM "resume" WHERE user_id=:user_id AND "resume"."name"=:name_resume');
                $command->bindValue(':user_id', $idUser);
                $command->bindValue(':name_resume', $nameResume);
                $resume = $command->queryOne();
                
                return $this->redirect('view?resume='.$resume['id']);

            } else {
                $errors['userStatus'] = 'Пользователь не найден';
                return $this->render('create', $this->initFieldForActionCreate($errors));
            }
        }
        else {
            return $this->redirect('my-resumes');
        }
    }
    
    /**
     * Methods for upload a file.
     * @return mixed
     */
    public function actionUpload()
    {
        if (array_key_exists('user-id', Yii::$app->request->queryParams)) {
            $userID = Yii::$app->request->queryParams['user-id'];
            $file1 = UploadedFile::getInstanceByName('file');
            if ($file1 != null) {
                $command = Yii::$app->db->createCommand('SELECT path, photo FROM "resume" WHERE user_id=:user_id');
                $command->bindValue(':user_id', $userID);
                $resume = $command->queryOne();
                $path = $resume['path'];
                
                try{
                    $file1->saveAs(Yii::getAlias('@webroot').'/ResumePhoto/'.$path.'/'.$file1->name);
                } catch (\Exception $ex) {
                    echo $ex;
                }
                $addressServer = 'http://localhost'. \yii\helpers\Url::to(['/']).'ResumePhoto/';
                $photo = '<img src="'. $addressServer. $path.'/'.$file1->name . '" alt="photo">';
                $postData = json_encode(array('photo' => $photo, 'photoName' => $file1->name), JSON_FORCE_OBJECT);
                echo $postData;
            } else {
                echo 'ERR';
            }
        } else {
            echo 'ERR';
        }
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
//         $date = '20.04.2012';
//         echo date('Y.m.d', strtotime($date));
        
//         $rand = rand( 99999, 999999);
//         echo $rand;
        exit();
        
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
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
       //$this->findModel($id)->delete();
        if (array_key_exists('resume', Yii::$app->request->queryParams)) {
            $resumeID = Yii::$app->request->queryParams['resume'];
            $resumeModel = new Resume();
            $resumeModel->deleteResume($resumeID);
        }
        return $this->redirect(['my-resumes']);
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
    


}
