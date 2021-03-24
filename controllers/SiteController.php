<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\rbac\DbManager;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Users;

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
        return $this->render('index');
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

    public function actionSignup()
    {
        $model = new Users();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->email = $_POST['Users']['email'];
                $model->password = password_hash($_POST['Users']['password'], PASSWORD_ARGON2I);
                $model->name = $_POST['Users']['name'];
                $model->surname = $_POST['Users']['surname'];
                $model->authKey = md5(random_bytes(5));
                $model->accessToken = password_hash(random_bytes(10), PASSWORD_DEFAULT);
                if($model->save()){
                  //Assegno il ruolo manager di default
                  $p_key = $model->getPrimaryKey();
                  $auth = new DbManager;
                  $manager = $auth->getRole('manager');
                  $auth->assign($manager, $p_key);
                  Yii::$app->session->setFlash('userSignedUp');
                  return $this->refresh();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
}
