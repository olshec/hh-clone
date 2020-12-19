<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
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
        self::activateMenuItem(MenuHeader::LIST_RESUME);
        return $this->render('index');    
    }
    
    /*
     * Activates menu item.
     * 
     * @param enum from MenuHeader, example MenuHeader::LIST_RESUME
     */
    public static function activateMenuItem(int $item){
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
        self::activateMenuItem(MenuHeader::RESUME);
        return $this->render('my-resume');
    }
    
    /**
     * Displays my resume list.
     *
     * @return string
     */
    public function actionResumeList()
    {
        self::activateMenuItem(MenuHeader::LIST_RESUME);
        return $this->render('resume-list');
    }
    
    /**
     * Displays edit resume.
     *
     * @return string
     */
    public function actionEditResume()
    {
        self::activateMenuItem(MenuHeader::RESUME);
        return $this->render('edit-reg-resume');
    }
    
    /**
     * Displays added new resume.
     *
     * @return string
     */
    public function actionAddResume()
    {
        self::activateMenuItem(MenuHeader::RESUME);
        return $this->render('add-new-resume');
    }
    
    /**
     * Displays resume view.
     *
     * @return string
     */
    public function actionResumeView()
    {
        self::activateMenuItem(MenuHeader::RESUME);
        return $this->render('resume-view');
    }
    
  
}



