<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectPpi */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="authors-project-ppi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'p_rcn')->textInput() ?>

    <?= $form->field($model, 'funding_scheme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'call_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ppi_firstname')->textInput() ?>

    <?= $form->field($model, 'ppi_lastname')->textInput() ?>

    <?= $form->field($model, 'organization_url')->textInput() ?>

    <?= $form->field($model, 'ppi_organization')->textInput() ?>

    <?= $form->field($model, 'erc_field')->textInput() ?>

    <?= $form->field($model, 'p_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
