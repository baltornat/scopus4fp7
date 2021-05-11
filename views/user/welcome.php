<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Welcome admin';
?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 border-bottom-warning">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome back!</h1>
                </div>
                <!-- Welcome admin -->
                <div class="text-center">
                    <br>
                    <?=Html::img(Yii::getAlias('@web').'/img/undraw_welcome_3gvl.svg', ['class' => 'error mx-auto']); ?><br><br><br>
                    <p class="text-gray-500 mb-0">This is an admin account so you have access to the following functionalities:</p><br>
                    <a href="<?=\yii\helpers\Url::to(['/user/index']) ?>">&larr; Manage users</a><br>
                    <a href="<?=\yii\helpers\Url::to(['/authors-project-ppi/index']) ?>">&larr; Manage projects</a><br>
                    <a href="<?=\yii\helpers\Url::to(['/authors-scopus-author/index']) ?>">&larr; Manage candidates</a><br>
                    <a href="<?=\yii\helpers\Url::to(['/statistics/index']) ?>">&larr; Statistics</a>
                </div>
            </div>
        </div>
    </div>
</div>
