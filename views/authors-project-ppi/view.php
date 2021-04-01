<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectPpi */

$this->title = "Project number $model->id";

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

    <?php
        $authors = \app\models\AuthorsScopusAuthor::find()
            ->joinWith('authorSubjectArea')
            ->joinWith('projectAuthorMatch')
            ->where(['scopus_author.project_ppi'=>$model->id])
            ->orderBy(['project_author_match.match_value'=>SORT_DESC])
            ->limit(10)
            ->all();
        if(empty($authors)){
            echo "<div class=\"alert alert-danger\"> No valid authors found!</div>";
        }else{
            foreach($authors as $author) {
                echo "<h1> Author ";
                echo $author->id;
                echo " - ";
                echo $author->firstname;
                echo " ";
                echo $author->lastname;
                echo "</h1>";
                echo DetailView::widget([
                    'model' => $author,
                    'attributes' => [
                        'projectAuthorMatch.match_value',
                        //'id',
                        //'project_ppi',
                        'author_scopus_id',
                        //'firstname',
                        //'lastname',
                        //'affil_id',
                        'affil_name',
                        'affil_city',
                        'affil_country',
                        'num_documents',
                        'author_modality',
                        'authorSubjectArea.area_short_name',
                        'authorSubjectArea.area_frequency',
                        'authorSubjectArea.area_long_name',
                    ],
                ]);
            }
        }
    ?>

</div>


