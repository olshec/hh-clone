<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MenuHeader;
use phpDocumentor\Reflection\Types\Integer;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('resume-list', ['resumeState' => '', 'listResumeState' => 'active']);
    }
    
    /*
     * Activates menu item.
     * 
     * @param enum from MenuHeader, example MenuHeader::LIST_RESUME
     */
    private function activateMenuItem(int $item){
        $menu = new MenuHeader();
        switch ($item){
            case MenuHeader::RESUME:
                $menu->activateResume();
                break;
            case MenuHeader::LIST_RESUME:
                $menu->activateListResume();
                break;
        }
        Yii::$app->params['menuHeader'] = $menu;
    }

    /**
     * Displays my resume.
     *
     * @return string
     */
    public function actionMyResume()
    {
        $this->activateMenuItem(MenuHeader::RESUME);
        return $this->render('my-resume');
    }
    
    /**
     * Displays my resume list.
     *
     * @return string
     */
    public function actionResumeList()
    {
        $this->activateMenuItem(MenuHeader::LIST_RESUME);
        return $this->render('resume-list');
    }
    
    /**
     * Displays edit resume.
     *
     * @return string
     */
    public function actionEditResume()
    {
        $this->activateMenuItem(MenuHeader::RESUME);
        return $this->render('edit-reg-resume');
    }
    
    /**
     * Displays added new resume.
     *
     * @return string
     */
    public function actionAddResume()
    {
        $this->activateMenuItem(MenuHeader::RESUME);
        return $this->render('add-new-resume');
    }
    
    /**
     * Displays resume view.
     *
     * @return string
     */
    public function actionResumeView()
    {
        $this->activateMenuItem(MenuHeader::RESUME);
        return $this->render('resume-view');
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
