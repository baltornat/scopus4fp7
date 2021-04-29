<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php if (Yii::$app->session->hasFlash('userSignedUp')): ?>
    <div class="container-fluid">
        <div class="alert alert-success">
            New account generated.
        </div>
        <!-- Signup success -->
        <div class="text-center">
            <p class="lead text-gray-800 mb-5">User created successfully</p>
            <p class="text-gray-500 mb-0">Now you can change his role in section "Manage users"</p><br>
            <a href="<?=\yii\helpers\Url::to(['/user/create']) ?>">&larr; Create another user</a><br>
            <a href="<?=\yii\helpers\Url::to(['/user/index']) ?>">&larr; Back to Manage users</a><br>
            <a href="<?=\yii\helpers\Url::to(['/authors-project-ppi/index']) ?>">&larr; Back to Manage projects</a><br>
            <a href="<?=\yii\helpers\Url::to(['/authors-scopus-author/index']) ?>">&larr; Back to Manage candidates</a>
        </div>

    </div>
<?php elseif (Yii::$app->session->hasFlash('userNotSignedUp')): ?>
    <div class="container">
        <div class="alert alert-danger">
            Error during account creation.
        </div>
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0 border-bottom-warning">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <?=Html::img(Yii::getAlias('@web').'/img/undraw_Access_account_re_8spm.svg', ['class' => 'col-lg-5 d-none d-lg-block', 'style' => 'position: relative; left: 30px;']); ?>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create new user</h1>
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
                            <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'signup-button']) ?>
                            <?php ActiveForm::end(); ?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?=\yii\helpers\Url::to(['/user/index']) ?>">Go to section "Manage users"</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                <h1 class="h4 text-gray-900 mb-4">Create new user</h1>
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
                            <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'signup-button']) ?>
                            <?php ActiveForm::end(); ?>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?=\yii\helpers\Url::to(['/user/index']) ?>">Go to section "Manage users"</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>