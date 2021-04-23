<?php

namespace app\controllers;

use app\models\AuthorsProjectAuthorMatch;
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
                'only' => ['update'],
                'rules' => [
                    [
                        'actions' => ['update'],
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
