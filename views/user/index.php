<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Users</h1>
    <p class="mb-4">Here are shown all the users registered to the application</p>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?=$this->title ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'pager' => [
                        'class' => \yii\bootstrap4\LinkPager::class
                    ],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id',
                        'email:email',
                        //'password',
                        'name',
                        'surname',
                        //'authKey',
                        //'accessToken',
                        'isDisabled:boolean',

                        ['class' => 'app\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
