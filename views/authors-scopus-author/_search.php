<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsScopusAuthorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authors-scopus-author-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_ppi') ?>

    <?= $form->field($model, 'author_scopus_id') ?>

    <?= $form->field($model, 'firstname') ?>

    <?= $form->field($model, 'lastname') ?>

    <?php // echo $form->field($model, 'affil_id') ?>

    <?php // echo $form->field($model, 'affil_name') ?>

    <?php // echo $form->field($model, 'affil_city') ?>

    <?php // echo $form->field($model, 'affil_country') ?>

    <?php // echo $form->field($model, 'num_documents') ?>

    <?php // echo $form->field($model, 'author_modality') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
