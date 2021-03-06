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
                        'label'=>'Organization',
                        'attribute' => 'ppiOrganization',
                        'value' => 'ppiOrganization.ppi_organization'
                    ],
                    [
                        'class' => 'app\grid\ActionColumn',
                    ],
                ];
                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'filename' => 'projects-grid-export',
                    'clearBuffers' => true,
                    'batchSize' => 20,
                    'exportConfig' => [
                        ExportMenu::FORMAT_PDF => false
                    ],
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
                            'label'=>'Organization',
                            'attribute' => 'ppiOrganization',
                            'value' => 'ppiOrganization.ppi_organization'
                        ],
                        [
                            'label'=>'P ID',
                            'attribute' => 'p_id',
                            'value' => 'ppiOrganization.p_id'
                        ],
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
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel'  => 'Last'
                    ],
                    'toolbar' => false,
                    'pjax' => true,
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-table\"></i> $this->title </h3>",
                        'after' => false,
                        'before' => false
                    ],
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
