<?php

namespace app\controllers;

use app\models\AuthorsProjectAuthorMatch;
use app\models\PublicationsPublicationSearch;
use Yii;
use app\models\AuthorsScopusAuthor;
use app\models\AuthorsScopusAuthorSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthorsScopusAuthorController implements the CRUD actions for AuthorsScopusAuthor model.
 */
class AuthorsScopusAuthorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create'],
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
     * Lists all AuthorsScopusAuthor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthorsScopusAuthorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthorsScopusAuthor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $project = \app\models\AuthorsProjectPpi::find()
            ->joinWith('ppiOrganization')
            ->where(['project_ppi.id'=>$model->project_ppi])
            ->one();
        $match = \app\models\AuthorsProjectAuthorMatch::find()
            ->where(['project_ppi'=>$model->project_ppi, 'author_scopus_id'=>$model->author_scopus_id])
            ->one();
        $searchModel = new PublicationsPublicationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model);
        return $this->render('view', [
            'model' => $model,
            'project' => $project,
            'match' => $match,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new AuthorsScopusAuthor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthorsScopusAuthor();
        if ($model->load(Yii::$app->request->post())) {
            $match = new AuthorsProjectAuthorMatch();
            $match->project_ppi = $model->project_ppi;
            $match->author_scopus_id = $model->author_scopus_id;
            $match->erc_field = Yii::$app->request->get('erc_field');
            $match->match_value = 1;
            if($match->save() && $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the AuthorsScopusAuthor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuthorsScopusAuthor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthorsScopusAuthor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
