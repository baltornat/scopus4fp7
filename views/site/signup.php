<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form ActiveForm */
$this->title = 'Sign Up';
?>
<div class="signup">
  <h1><?= Html::encode($this->title) ?></h1>

  <p>Please fill out the following fields to sign up:</p>

  <?php $form = ActiveForm::begin([
      'id' => 'login-form',
      'layout' => 'horizontal',
      'fieldConfig' => [
          'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
          'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
  ]); ?>

        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'nome') ?>
        <?= $form->field($model, 'cognome') ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- signup -->
