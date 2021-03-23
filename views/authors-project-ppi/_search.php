<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectPpiSearch */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="authors-project-ppi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'p_rcn') ?>

    <?= $form->field($model, 'funding_scheme') ?>

    <?= $form->field($model, 'call_year') ?>

    <?= $form->field($model, 'ppi_firstname') ?>

    <?php // echo $form->field($model, 'ppi_lastname') ?>

    <?php // echo $form->field($model, 'organization_url') ?>

    <?php // echo $form->field($model, 'ppi_organization') ?>

    <?php // echo $form->field($model, 'erc_field') ?>

    <?php // echo $form->field($model, 'p_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
