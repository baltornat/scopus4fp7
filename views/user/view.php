<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">User <strong><?=$model->name?> <?=$model->surname?></strong></h1>
    <p class="mb-4">Here is shown all data about the specified user</p>
    <div class="card shadow mb-4 border-bottom-warning">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'group'=>true,
                            'label'=>'SECTION 1: Unmodifiables',
                            'rowOptions'=>['class'=>'table-danger']
                        ],
                        'id',
                        [
                            'group'=>true,
                            'label'=>'SECTION 2: Identification Data',
                            'rowOptions'=>['class'=>'table-info'],
                        ],
                        [
                            'label'=>'Role',
                            'attribute'=>'id',
                            'value'=>$model->authAssignment->item_name,
                        ],
                        'email:email',
                        'name',
                        'surname',
                        'isDisabled:boolean',
                    ],
                    'mode' => 'view',
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'panel' => [
                        'type' => DetailView::TYPE_PRIMARY,
                        'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-user\"></i> $this->title </h3>",
                    ],
                    'enableEditMode' => false
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

