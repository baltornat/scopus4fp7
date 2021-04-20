<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsProjectAuthorMatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors Project Author Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-project-author-match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Authors Project Author Match', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_ppi',
            'author_scopus_id',
            'erc_field',
            'match_value',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
