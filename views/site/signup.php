<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
$this->title = 'Sign up';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="signup">
  <h1><?= Html::encode($this->title) ?></h1>
  <?php if (Yii::$app->session->hasFlash('userSignedUp')): ?>

        <div class="alert alert-success">
            Your account was successfully created.
        </div>
  <?php else: ?>
        <p>Please fill out the following fields to sign up:</p>

          <?php $form = ActiveForm::begin([
              'id' => 'signup-form',
              'layout' => 'horizontal',
              'fieldConfig' => [
                  'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                  'horizontalCssClasses' => [
                      'offset' => 'offset-sm-3',
                      'label' => 'col-lg-1',
                      'wrapper' => 'col-sm-4',
                      'error' => '',
                      'hint' => 'col-sm-3',
                  ],
              ],
          ]); ?>

              <?= $form->field($model, 'email')->textInput() ?>
              <?= $form->field($model, 'password')->passwordInput() ?>
              <?= $form->field($model, 'name')->textInput() ?>
              <?= $form->field($model, 'surname')->textInput() ?>

              <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
              </div>
          <?php ActiveForm::end(); ?>

  <?php endif; ?>
</div><!-- signup -->
