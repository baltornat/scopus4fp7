<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsProjectPpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors Project Ppis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Projects</h1>
    <p class="mb-4">Here are shown all the projects</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$this->title ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => [
                        'class' => \yii\bootstrap4\LinkPager::class,
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        //'p_rcn',
                        'funding_scheme',
                        'call_year',
                        'ppi_firstname',
                        'ppi_lastname',
                        'organization_url:url',
                        [
                            'label'=>'Institution name',
                            'attribute'=>'ppi_organization',
                            'value'=>function($model){
                                $institution = \app\models\AuthorsInstitution::find()->where(['md_institution_tokens'=>$model->ppi_organization])->one();
                                if(empty($institution)){
                                    return null;
                                }
                                return $institution->institution_name;
                            }
                        ],
                        'erc_field',
                        //'p_id',

                        ['class' => 'app\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
