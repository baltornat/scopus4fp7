<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">User informations</h1>
    <p class="mb-4">Here are shown all the users registered to the application</p>
    <div class="card shadow mb-4 border-bottom-warning">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                    $gridColumns = [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                            'width' => '20px',
                        ],
                        'email',
                        'name',
                        'surname',
                        [
                            'label' => 'Role',
                            'attribute' => 'authKey',
                            'value' => 'authAssignment.item_name'
                        ],
                        [
                            'class' => 'kartik\grid\BooleanColumn',
                            'label' => 'Disabled?',
                            'attribute' => 'isDisabled',
                            'trueLabel' => 'Yes',
                            'falseLabel' => 'No'
                        ],
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'width' => '100px',
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
                            'email',
                            'name',
                            'surname',
                            [
                                'label' => 'Role',
                                'attribute' => 'authKey',
                                'value' => 'authAssignment.item_name'
                            ],
                            [
                                'class' => 'kartik\grid\BooleanColumn',
                                'attribute' => 'isDisabled',
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
