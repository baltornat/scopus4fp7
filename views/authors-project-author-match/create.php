<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectAuthorMatch */

$this->title = 'Create Authors Project Author Match';
$this->params['breadcrumbs'][] = ['label' => 'Authors Project Author Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-project-author-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
