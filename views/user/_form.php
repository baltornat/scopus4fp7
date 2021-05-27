<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model->authAssignment, 'item_name')->dropdownList([
        'admin' => 'admin',
        'manager' => 'manager'
        ],
        ['prompt'=>'Select Role']
        )->label('Role');
    ?>
    <?= $form->field($model, 'isDisabled')->checkbox() ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-user btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
