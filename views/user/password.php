<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $model app\models\User */

$this->title = 'Change password';
?>
<?php if (Yii::$app->session->hasFlash('passwordChanged')): ?>
<div class="container-fluid">
    <div class="alert alert-success">
        Password changed succesfully!
    </div>
    <div class="text-center">
        <a class="small" href="<?=\yii\helpers\Url::to(['/user/info', 'id'=>$model->id]) ?>">Check your profile</a>
    </div>
</div>
<?php else:; ?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0 border-bottom-warning">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <?=Html::img(Yii::getAlias('@web').'/img/undraw_my_password_d6kg.svg', ['class' => 'col-lg-5 d-none d-lg-block', 'style' => 'position: relative; left: 30px;']); ?>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Change your password<br><br> <?=$model->email ?> </h1>
                                </div>
                                <div class="form-group">
                                    <?php $form = ActiveForm::begin([
                                        'method' => 'post',
                                        'id' => 'password-form',
                                    ]); ?>
                                    <div class="form-group">
                                        <?= $form->field($model, 'password', )->passwordInput(['value'=>''])->label('New password') ?>
                                    </div>
                                    <?= Html::submitButton('Change password', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'password-button']) ?>
                                    <?php ActiveForm::end(); ?>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?=\yii\helpers\Url::to(['/user/info', 'id'=>$model->id]) ?>">Check your profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?php endif; ?>
