<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */
$this->title = 'Sign up';
?>

<?php if (Yii::$app->session->hasFlash('userSignedUp')): ?>
    <div class="container-fluid">
        <div class="alert alert-success">
            Your account was generated.
        </div>
        <!-- Signup success -->
        <div class="text-center">
            <p class="lead text-gray-800 mb-5">User created successfully</p>
            <p class="text-gray-500 mb-0">Now you can login to enjoy the app</p><br>
            <a href="<?=\yii\helpers\Url::to(['/site/login']) ?>">&larr; Back to Login</a><br>
            <a href="<?=\yii\helpers\Url::to(['/site/index']) ?>">&larr; Back to Home</a>
        </div>

    </div>
<?php else: ?>
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 border-bottom-warning">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <?=Html::img(Yii::getAlias('@web').'/img/undraw_Access_account_re_8spm.svg', ['class' => 'col-lg-5 d-none d-lg-block']); ?>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                                <?php $form = ActiveForm::begin([
                                    'id' => 'signup-form',
                                ]); ?>
                                <div class="form-group">
                                    <?= $form->field($model, 'email')->textInput() ?>
                                </div>
                                <div class="form-group">
                                    <?= $form->field($model, 'password')->passwordInput() ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <?= $form->field($model, 'name')->textInput() ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <?= $form->field($model, 'surname')->textInput() ?>
                                    </div>
                                </div>
                                <?= Html::submitButton('Register now', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'signup-button']) ?>
                                <?php ActiveForm::end(); ?>
                                <hr>
                            <div class="text-center">
                                <a class="small" href="<?=\yii\helpers\Url::to(['/site/login']) ?>">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

