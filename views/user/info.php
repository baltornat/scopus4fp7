<?php

use kartik\detail\DetailView;
use yii\helpers\Html;

/* @var $model app\models\User */

$this->title = 'Profile';
?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 border-bottom-warning">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <?=Html::img(Yii::getAlias('@web').'/img/undraw_profile.svg', ['class' => 'col-lg-5 d-none d-lg-block', 'style' => 'position: relative; left: 30px;']); ?>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Profile of <?=$model->email ?></h1>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo DetailView::widget([
                                        'model' => $model,
                                        'attributes' => [
                                            [
                                                'label'=>'Role',
                                                'attribute'=>'id',
                                                'value'=>$model->authAssignment->item_name,
                                            ],
                                            'email:email',
                                            'name',
                                            'surname',
                                        ],
                                        'mode' => 'view',
                                        'bordered' => true,
                                        'striped' => false,
                                        'condensed' => false,
                                        'responsive' => true,
                                        'hover' => true,
                                        'panel' => [
                                            'type' => DetailView::TYPE_INFO,
                                            'heading' => "<h3 class=\"panel-title\" style=\"color: black\"><i class=\"fas fa-user\"></i> Personal data </h3>",
                                        ],
                                        'enableEditMode' => false
                                    ]);
                                    ?>
                                </div>
                                <!-- Link -->
                                <div class="text-center">
                                    <a href="<?=\yii\helpers\Url::to(['/user/password', 'id' => $model->id]) ?>">&larr; Change password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
