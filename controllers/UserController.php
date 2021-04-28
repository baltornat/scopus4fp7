<?php

namespace app\controllers;

use app\models\AuthAssignment;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $user = User::find()
                    ->select('id')
                    ->orderBy(['id'=>SORT_DESC])
                    ->one();
                $max = (int)$user->id + 1;
                $max = (string)$max;
                $model->id = $max;
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
                }else{
                    Yii::$app->session->setFlash('userNotSignedUp');
                    return $this->refresh();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $auth = new AuthAssignment();
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save() && $auth->load(Yii::$app->request->post())) {
            $actualRole = Yii::$app->authManager->getRolesByUser($id);
            if($auth->item_name != $actualRole){
                switch($auth->item_name){
                    case 'manager':
                        // Revoke current role
                        $manager = Yii::$app->authManager;
                        $manager->revokeAll($id);
                        // Assign new role manager
                        $newRole = $manager->getRole('manager');
                        $manager->assign($newRole, $id);
                        break;
                    case 'admin':
                        // Revoke current role
                        $admin = Yii::$app->authManager;
                        $admin->revokeAll($id);
                        // Assign new role manager
                        $newRole = $admin->getRole('admin');
                        $admin->assign($newRole, $id);
                        break;
                    default:
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = Yii::$app->authManager;
        $user->revokeAll($id);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
