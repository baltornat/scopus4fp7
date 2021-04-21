<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsProjectPpiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Projects data</h1>
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
                        'erc_field',
                        'funding_scheme',
                        'call_year',
                        'ppi_firstname',
                        'ppi_lastname',
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
                            'class' => 'app\grid\ActionColumn',
                        ],
                    ];
                    echo ExportMenu::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                [
                                    'class' => 'kartik\grid\SerialColumn',
                                    'exportMenuStyle' => [ // format the serial column cells
                                        'fill' => [
                                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                            'color' => ['argb' => 'FFE5E5E5']
                                        ]
                                    ]
                                ],
                                'id',
                                'p_rcn',
                                'erc_field',
                                'funding_scheme',
                                'call_year',
                                'ppi_firstname',
                                'ppi_lastname',
                                'organization_url',
                                'ppi_organization',
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
                                'p_id',
                            ],
                            'dropdownOptions' => [
                                'label' => 'Export All',
                                'class' => 'btn btn-outline-secondary'
                            ]
                        ]);
                    echo "<br><br>";
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                        'toolbar' => false,
                        'pjax' => true,
                        'bordered' => true,
                        'striped' => false,
                        'condensed' => false,
                        'responsive' => true,
                        'hover' => true,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => "<h3 class=\"panel-title\"><i class=\"glyphicon glyphicon-user\"></i> $this->title </h3>",
                            'after' => false,
                            'before' => false
                        ],
                    ]);
                ?>

            </div>
        </div>
    </div>
</div>
