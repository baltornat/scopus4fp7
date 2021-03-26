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
    <?php
        foreach(\app\models\AuthorsScopusAuthor::find()->where(['project_ppi'=>$model->id])->each(5) as $author){
            echo "<div class=\"alert alert-success\"> Author number: ";
            echo $author->id;
            echo "</div>";
            echo DetailView::widget([
                'model' => $author,
                'attributes' => [
                        'id',
                        'author_scopus_id',
                        'firstname',
                        'lastname',
                        'affil_id',
                        'affil_name',
                        'affil_city',
                        'affil_country',
                        'num_documents',
                        'author_modality',
                ],
            ]);
        }
        if(empty($author)) {
            echo "<div class=\"alert alert-danger\">
                     No authors were found! 
                  </div>";
        }
    ?>


</div>
