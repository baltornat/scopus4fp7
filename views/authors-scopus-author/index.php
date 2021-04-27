<?php

use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsScopusAuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidate authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Candidates data</h1>
    <p class="mb-4">Here are shown all the candidate authors</p>
    <div class="card shadow mb-4 border-bottom-warning">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                    $gridColumns = [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                            'width' => '20px',
                        ],
                        'author_scopus_id',
                        'firstname',
                        'lastname',
                        'affil_name',
                        'affil_city',
                        'affil_country',
                        'num_documents',
                        'author_modality',
                        [
                            'class' => 'app\grid\ActionColumn',
                        ],
                    ];
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'filename' => 'candidates-grid-export',
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
                            'project_ppi',
                            'author_scopus_id',
                            'firstname',
                            'lastname',
                            'affil_id',
                            'affil_name',
                            'affil_city',
                            'affil_country',
                            'num_documents',
                            'author_modality',
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
                            'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-users\"></i> $this->title </h3>",
                            'after' => false,
                            'before' => false
                        ],
                    ]);
                ?>

            </div>
        </div>
    </div>
</div>
