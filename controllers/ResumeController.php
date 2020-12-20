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

        $command = Yii::$app->db->createCommand('SELECT * FROM "resume"');
        $resumeModels = $command->queryAll();
//         foreach ($resumeModels as $resume){
//             $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE id=:user_id');
//             $command->bindValue(':user_id', $resume['user_id']);
//             $user = $command->queryOne();
//             $resume['user'] = $user;
//         }
        
        for ($i=0;$i<count($resumeModels);$i++){
            $resume=$resumeModels[$i];
            $command = Yii::$app->db->createCommand('SELECT * FROM "user" WHERE id=:user_id');
            $command->bindValue(':user_id', $resume['user_id']);
            $user = $command->queryOne();
            $resumeModels[$i]['city'] = $user['city'];
            //count age
            $dateNow = new DateTime(date('Y-m-d'));
            $dateBirthString = $user['date_birth'];
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
            $resumeModels[$i]['age'] = $age;
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
}
