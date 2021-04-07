<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
?>

<div class="container">
    <?php if (Yii::$app->session->hasFlash('userBanned')): ?>

        <div class="alert alert-danger">
            Your account was banned.
        </div>
    <?php else: ?>

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 border-bottom-warning">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                ]); ?>
                                <div class="form-group">
                                    <?= $form->field($model, 'email')->textInput() ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($model, 'password')->passwordInput() ?>
                                </div>
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'login-button']) ?>
                                <?php ActiveForm::end(); ?>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="<?=\yii\helpers\Url::to(['/site/signup']) ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <?php endif; ?>

</div>