<?php

use kartik\export\ExportMenu;
use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">User data</h1>
    <p class="mb-4">Here are shown all the users registered to the application</p>
    <div class="row">
        <!-- Create new user -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Add new user</div><br>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= Html::a('Create', ['create'], ['class' => 'btn btn-primary']) ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            'class' => 'kartik\grid\EnumColumn',
                            'enum' => ['admin', 'manager'],
                            'filter' => [
                                'admin' => 'admin',
                                'manager' => 'manager',
                            ],
                            'label' => 'Role',
                            'attribute' => 'authAssignment',
                            'value' => 'authAssignment.item_name'
                        ],
                        [
                            'class' => 'kartik\grid\BooleanColumn',
                            'label' => 'Is disabled',
                            'attribute' => 'isDisabled',
                            'trueIcon' => '<span class="fas fa-times" style="color: red"></span>',
                            'trueLabel' => 'Yes',
                            'falseIcon' => '<span class="fas fa-check" style="color: limegreen"></span>',
                            'falseLabel' => 'No',
                        ],
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'width' => '100px',
                        ],
                    ];
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'filename' => 'users-grid-export',
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
                            'email',
                            'password',
                            'name',
                            'surname',
                            [
                                'class' => 'kartik\grid\EnumColumn',
                                'enum' => ['admin', 'manager'],
                                'filter' => [
                                    'admin' => 'admin',
                                    'manager' => 'manager',
                                ],
                                'label' => 'Role',
                                'attribute' => 'authAssignment',
                                'value' => 'authAssignment.item_name'
                            ],
                            'accessToken',
                            [
                                'class' => 'kartik\grid\BooleanColumn',
                                'label' => 'Is disabled',
                                'attribute' => 'isDisabled',
                                'trueLabel' => 'Yes',
                                'falseLabel' => 'No',
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
                        'pjax' => true,
                        'bordered' => true,
                        'striped' => false,
                        'condensed' => false,
                        'responsive' => true,
                        'hover' => true,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-cog\"></i> $this->title </h3>",
                            'after' => false,
                            'before' => false
                        ],
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
