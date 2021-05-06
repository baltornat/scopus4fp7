<?php

namespace app\controllers;

use Yii;
use app\models\AuthorsProjectPpi;
use app\models\AuthorsProjectPpiSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthorsProjectPpiController implements the CRUD actions for AuthorsProjectPpi model.
 */
class AuthorsProjectPpiController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'welcome'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'welcome'],
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

    public function actionWelcome()
    {
        return $this->render('welcome');
    }

    /**
     * Lists all AuthorsProjectPpi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthorsProjectPpiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthorsProjectPpi model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $authors = \app\models\AuthorsScopusAuthor::find()
            ->joinWith('authorSubjectArea')
            ->joinWith('projectAuthorMatch')
            ->where(['scopus_author.project_ppi'=>$model->id])
            ->andWhere(['>=', 'match_value', 0])
            ->orderBy(['project_author_match.match_value'=>SORT_DESC])
            ->limit(10)
            ->all();
        $mappings = \app\models\AuthorsMappingErcScopus::find()
            ->joinWith('projectPpi')
            ->where(['mapping_erc_scopus.erc_field'=>$model->erc_field])
            ->orderBy(['relevance'=>SORT_DESC])
            ->all();
        return $this->render('view', [
            'model' => $model,
            'authors' => $authors,
            'mappings' => $mappings,
        ]);
    }

    /**
     * Finds the AuthorsProjectPpi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuthorsProjectPpi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthorsProjectPpi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
