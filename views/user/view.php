<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">User <?=$model->name?> <?=$model->surname?></h1>
    <p class="mb-4">Here are shown all the informations about the specified user</p>
    <div class="card shadow mb-4 border-bottom-warning">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informations</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'email:email',
                        'password',
                        'name',
                        'surname',
                        'authKey',
                        'accessToken',
                        'isDisabled:boolean',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

