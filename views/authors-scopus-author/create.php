<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsScopusAuthor */

$request = Yii::$app->request;
$model->project_ppi = $request->get('project_ppi');
$erc_field = $request->get('erc_field');

$this->title = 'Add new candidate';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['authors-project-ppi/index']];
$this->params['breadcrumbs'][] = ['label' => "Project number $model->project_ppi", 'url' => ['authors-project-ppi/view', 'id' => $model->project_ppi]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0 border-bottom-warning">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <?=Html::img(Yii::getAlias('@web').'/img/undraw_Access_account_re_8spm.svg', ['class' => 'col-lg-5 d-none d-lg-block']); ?>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Add new candidate</h1>
                        </div>
                        <?php $form = ActiveForm::begin([
                            'id' => 'candidate-form',
                            'action' => ['create','erc_field'=>$erc_field]
                        ]); ?>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <?= $form->field($model, 'project_ppi') ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'author_scopus_id')->textInput() ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <?= $form->field($model, 'firstname')->textInput() ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'lastname')->textInput() ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= $form->field($model, 'affil_name')->textInput() ?>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <?= $form->field($model, 'affil_city')->textInput() ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'affil_country')->textInput() ?>
                            </div>
                        </div>
                        <?= Html::submitButton('Add candidate', ['class' => 'btn btn-primary btn-user btn-block', 'name' => 'candidate-button']) ?>
                        <?php ActiveForm::end(); ?>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
