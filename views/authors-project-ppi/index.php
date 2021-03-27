<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsProjectPpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors Project Ppis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-project-ppi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Authors Project Ppi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
          'class' => \yii\bootstrap4\LinkPager::class
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'funding_scheme',
            'call_year',
            'ppi_firstname',
            'ppi_lastname',
            'organization_url:url',
            'ppi_organization',
            [
                'label'=>'Institution name',
                'attribute'=>'erc_field',
                'value'=>function($model){
                    $institution = \app\models\AuthorsInstitution::find()->where(['md_institution_tokens'=>$model->erc_field])->one();
                    if(empty($institution)){
                        return null;
                    }
                    return $institution->institution_name;
                }
            ],


            ['class' => 'app\grid\ActionColumn'],
        ],
    ]); ?>


</div>
