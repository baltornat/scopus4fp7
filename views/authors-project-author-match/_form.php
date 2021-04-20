<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectAuthorMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authors-project-author-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_ppi')->textInput() ?>

    <?= $form->field($model, 'author_scopus_id')->textInput() ?>

    <?= $form->field($model, 'erc_field')->textInput() ?>

    <?= $form->field($model, 'match_value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
