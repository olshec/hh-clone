<?php

namespace app\controllers;

use DateTime;
use Yii;
use app\models\MenuHeader;
use app\models\Resume;
use app\models\ResumeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
     * Lists all Resume models.
     * @return mixed
     */
    public function actionIndex()
    {
//         $searchModel = new ResumeSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//         return $this->render('index', [
//             'searchModel' => $searchModel,
//             'dataProvider' => $dataProvider,
//         ]);

        //filling in resume data
        $command = Yii::$app->db->createCommand('SELECT * FROM "resume"');
        $resumeModels = $command->queryAll();
        for ($i=0; $i < count($resumeModels); $i++){
            $resume=$resumeModels[$i];
            $user = $this->getUser($resume['user_id']);
            $resumeModels[$i]['city'] = $user['city'];
            $resumeModels[$i]['age'] = $this->getFormatAge($user['date_birth']);
            $resumeModels[$i]['infoAboutLastWork'] = $this->getInfoAboutLastPlaceOfWork($resume['user_id']);
            //print_r($dateDiff);
           // exit();
        }
        
//          print_r($resumeModels);
//          exit();
        //$idUser = $post['id'];
        
        SiteController::activateMenuItem(MenuHeader::LIST_RESUME);
        return $this->render('index', [
            'resumeModels' => $resumeModels
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
        $dateEndWork = $lastPlaceOfWork['date_end'];
        //list of month
        $_monthsList = array(
            "01"=>"Январь","02"=>"Февраль","03"=>"Март",
            "04"=>"Апрель","05"=>"Май", "06"=>"Июнь",
            "07"=>"Июль","08"=>"Август","09"=>"Сентябрь",
            "10"=>"Октябрь","11"=>"Ноябрь","12"=>"Декабрь");
        $dateStart = new DateTime($dateStartWork);
        $monthStartWork = $_monthsList[$dateStart->format('m')];
        $monthAndYearStart = $monthStartWork." ".$dateStart->format('y');
        
        if($dateEndWork == "0") {
            $monthAndYearFinish = "настоящее время";
        } else {
            $dateEnd = new DateTime($dateEndWork);
            $monthFinishWork = $_monthsList[$dateEnd->format('m')];
            $monthAndYearFinish = $monthFinishWork." ".$dateEnd->format('y');
        }
        
//          echo $month;
//          exit;
        //выведет, например, для 7 месяца "Июль"
        
        $infoAboutLastWork = "Младший PHP разработчик в ".$lastPlaceOfWork['name_organization'].
        ", ".$monthAndYearStart.' — по '." ".$monthAndYearFinish;
        return $lastPlaceOfWork['infoAboutLastWork'] = $infoAboutLastWork;
    }
    
}
