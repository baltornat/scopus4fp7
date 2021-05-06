<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
?>
<?php if (Yii::$app->session->hasFlash('userBanned')): ?>
    <div class="container-fluid">
        <div class="alert alert-danger">
            Your account was banned.
        </div>
        <!-- Account banned -->
        <div class="text-center"><br>
            <p class="lead text-gray-800 mb-5">Blocked!</p>
            <p class="text-gray-500 mb-0">You cannot use this app anymore</p><br>
            <a href="<?=\yii\helpers\Url::to(['/site/index']) ?>">&larr; Back to Login</a><br>
        </div>

    </div>
<?php else: ?>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0 border-bottom-warning">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <?=Html::img(Yii::getAlias('@web').'/img/undraw_Sign_in_re_o58h.svg', ['class' => 'col-lg-5 d-none d-lg-block', 'style' => 'position: relative; left: 30px;']); ?>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login to Scopus <sup>4FP7</sup></h1>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
<?php endif; ?>


