<?php

namespace app\controllers;

use Yii;
use app\models\AuthorsProjectAuthorMatch;
use app\models\AuthorsProjectAuthorMatchSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthorsProjectAuthorMatchController implements the CRUD actions for AuthorsProjectAuthorMatch model.
 */
class AuthorsProjectAuthorMatchController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update'],
                        'allow' => true,
                        'roles' => ['manager'],
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
     * Lists all AuthorsProjectAuthorMatch models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthorsProjectAuthorMatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthorsProjectAuthorMatch model.
     * @param integer $project_ppi
     * @param string $author_scopus_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($project_ppi, $author_scopus_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($project_ppi, $author_scopus_id),
        ]);
    }

    /**
     * Creates a new AuthorsProjectAuthorMatch model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthorsProjectAuthorMatch();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'project_ppi' => $model->project_ppi, 'author_scopus_id' => $model->author_scopus_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthorsProjectAuthorMatch model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $project_ppi
     * @param string $author_scopus_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($project_ppi, $author_scopus_id)
    {
        $model = $this->findModel($project_ppi, $author_scopus_id);
        $model->match_value = -1;
        if ($model->save()) {
            return $this->redirect(['//authors-project-ppi/view', 'id' => $model->project_ppi]);
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Deletes an existing AuthorsProjectAuthorMatch model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $project_ppi
     * @param string $author_scopus_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($project_ppi, $author_scopus_id)
    {
        $this->findModel($project_ppi, $author_scopus_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthorsProjectAuthorMatch model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $project_ppi
     * @param string $author_scopus_id
     * @return AuthorsProjectAuthorMatch the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($project_ppi, $author_scopus_id)
    {
        if (($model = AuthorsProjectAuthorMatch::findOne(['project_ppi' => $project_ppi, 'author_scopus_id' => $author_scopus_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
