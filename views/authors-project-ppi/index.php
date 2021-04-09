<?php

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsProjectPpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors Project Ppis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Project informations</h1>
    <p class="mb-4">Here are shown all the projects</p>
    <div class="card shadow mb-4 border-bottom-warning">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                    $gridColumns = [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                            'width' => '20px',
                        ],
                        [
                            'attribute' => 'funding_scheme',
                        ],
                        [
                            'attribute' => 'call_year',
                        ],
                        [
                            'attribute' => 'ppi_firstname',
                        ],
                        [
                            'attribute' => 'ppi_lastname',
                        ],
                        [
                            'attribute' => 'organization_url',
                        ],
                        [
                            'label'=>'Institution name',
                            'attribute' => 'ppi_organization',
                            'value'=>function($model){
                                $institution = \app\models\AuthorsInstitution::find()->where(['md_institution_tokens'=>$model->ppi_organization])->one();
                                if(empty($institution)){
                                    return null;
                                }
                                return $institution->institution_name;
                            }
                        ],
                        [
                            'attribute' => 'erc_field',
                        ],
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'width' => '100px',
                        ],
                    ];
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                        'toolbar' =>  [
                            '{export}'
                        ],
                        'pjax' => true,
                        'bordered' => true,
                        'striped' => false,
                        'condensed' => false,
                        'responsive' => true,
                        'hover' => true,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => "<h3 class=\"panel-title\"><i class=\"glyphicon glyphicon-user\"></i> $this->title </h3>",
                            'after' => false
                        ],
                    ]);
                ?>

            </div>
        </div>
    </div>
</div>
