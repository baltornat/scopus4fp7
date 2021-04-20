<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AuthorsScopusAuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Authors Scopus Authors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-scopus-author-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Authors Scopus Author', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'project_ppi',
            'author_scopus_id',
            'firstname',
            'lastname',
            //'affil_id',
            //'affil_name',
            //'affil_city',
            //'affil_country',
            //'num_documents',
            //'author_modality',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
