<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectPpi */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Authors Project Ppis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="authors-project-ppi-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'p_rcn',
            'funding_scheme',
            'call_year',
            'ppi_firstname',
            'ppi_lastname',
            'organization_url:url',
            'ppi_organization',
            'erc_field',
            'p_id',
        ],
    ]) ?>

</div>
