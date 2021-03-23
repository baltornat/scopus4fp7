<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectPpi */

$this->title = 'Create Authors Project Ppi';
$this->params['breadcrumbs'][] = ['label' => 'Authors Project Ppis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-project-ppi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
