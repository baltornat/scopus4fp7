<?php

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
                        [
                            'attribute' => 'email',
                        ],
                        [
                            'attribute' => 'name',
                        ],
                        [
                            'attribute' => 'surname',
                        ],
                        [
                            'label' => 'Role',
                            'attribute' => 'authKey',
                            'value' => 'authAssignment.item_name'
                        ],
                        [
                            'class' => 'kartik\grid\BooleanColumn',
                            'attribute' => 'isDisabled',
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
                        //'showPageSummary' => true,
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
