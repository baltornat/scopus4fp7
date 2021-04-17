<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;

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
     * Login action.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->can('manageUser')) {
                return $this->render('//user/welcome');
            }
            return $this->render('//authors-project-ppi/welcome');
        }

        $model = new LoginForm();
        if($model->load(Yii::$app->request->post())){
            $user = \app\models\User::find()
                ->where(['email'=>$model->email])
                ->one();
            if(!empty($user)){
                if($user->isDisabled){
                    $model->password = '';
                    Yii::$app->session->setFlash('userBanned');
                    return $this->render('index', [
                        'model' => $model,
                    ]);
                }
            }
            if($model->login()){
                return $this->goBack();
            }
        }

        $model->password = '';
        return $this->render('index', [
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
}
