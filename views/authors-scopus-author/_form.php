<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsScopusAuthor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authors-scopus-author-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_ppi')->textInput() ?>

    <?= $form->field($model, 'author_scopus_id')->textInput() ?>

    <?= $form->field($model, 'firstname')->textInput() ?>

    <?= $form->field($model, 'lastname')->textInput() ?>

    <?= $form->field($model, 'affil_id')->textInput() ?>

    <?= $form->field($model, 'affil_name')->textInput() ?>

    <?= $form->field($model, 'affil_city')->textInput() ?>

    <?= $form->field($model, 'affil_country')->textInput() ?>

    <?= $form->field($model, 'num_documents')->textInput() ?>

    <?= $form->field($model, 'author_modality')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
