<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;

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
      /*if ($model->load(Yii::$app->request->post()) && $model->login()) {
          return $this->goBack();
      }*/
      if($model->load(Yii::$app->request->post())){
          $user = \app\models\User::find()
              ->where(['email'=>$model->email])
              ->one();
          if(!empty($user)){
              if($user->isDisabled){
                  $model->password = '';
                  Yii::$app->session->setFlash('userBanned');
                  return $this->render('login', [
                      'model' => $model,
                  ]);
              }
          }
          if($model->login()){
              return $this->goBack();
          }
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
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $model->email = $_POST['User']['email'];
                $model->password = password_hash($_POST['User']['password'], PASSWORD_ARGON2I);
                $model->name = $_POST['User']['name'];
                $model->surname = $_POST['User']['surname'];
                $model->authKey = md5(random_bytes(5));
                $model->accessToken = password_hash(random_bytes(10), PASSWORD_DEFAULT);
                if($model->save()){
                  // assign role "manager" by default
                  $p_key = $model->getPrimaryKey();
                  $auth = Yii::$app->authManager;
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
