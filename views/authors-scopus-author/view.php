<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsScopusAuthor */
/* @var $projects */
/* @var $match */

$this->title = "Candidate "."$model->id";
$this->params['breadcrumbs'][] = ['label' => 'Candidate authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Candidate author <?=$model->firstname?> <?=$model->lastname?></h1>
    <p class="mb-4">Here is shown all data about the specified candidate author</p>
    <div class="card shadow mb-4 border-bottom-warning">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'group'=>true,
                                'label'=>'SECTION 1: Identification Data',
                                'rowOptions'=>['class'=>'table-info']
                            ],
                            'author_scopus_id',
                            'firstname',
                            'lastname',
                            [
                                'group'=>true,
                                'label'=>'SECTION 2: Affiliation Data',
                                'rowOptions'=>['class'=>'table-info'],
                            ],
                            'affil_name',
                            'affil_city',
                            'affil_country',
                            [
                                'group'=>true,
                                'label'=>'SECTION 3: Other Data',
                                'rowOptions'=>['class'=>'table-warning'],
                            ],
                            'num_documents',
                            'author_modality',
                        ],
                        'mode' => 'view',
                        'bordered' => true,
                        'striped' => false,
                        'condensed' => false,
                        'responsive' => true,
                        'hover' => true,
                        'panel' => [
                            'type' => DetailView::TYPE_PRIMARY,
                            'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-user\"></i> ID: $model->id </h3>",
                        ],
                        'enableEditMode' => false
                    ]);
                ?>
            </div>
        </div>
    </div>

    <!-- Candidates -->
    <?php
        if($match->match_value < 0){
            echo "<div class=\"alert alert-danger\"> Match value <0 for this candidate! </div>";
        }else{
            if(empty($projects)){
                echo "<div class=\"alert alert-danger\"> No projects found for this candidate!</div>";
            }else{
                foreach($projects as $project) {
                    $institution = \app\models\AuthorsInstitution::find()
                        ->select('institution_name')
                        ->where(['md_institution_tokens'=>$project->ppi_organization])
                        ->limit(1)
                        ->one();
                    $info = "Project ".$project->id;
                    $url = \yii\helpers\Url::toRoute(['/authors-project-ppi/view', 'id' => $project->id]);
                    echo "
                        <div class=\"card shadow mb-4 border-bottom-primary\">
                            <div class=\"card-header py-3\">
                                <h6 class=\"h4 m-0 font-weight-bold text-primary\">All the projects linked to this candidate</h6>
                            </div>
                            <div class=\"card-body\">
                                <div class=\"table-responsive\">
                    ";
                    echo DetailView::widget([
                        'model' => $project,
                        'attributes' => [
                            'erc_field',
                            'funding_scheme',
                            'call_year',
                            'ppi_firstname',
                            'ppi_lastname',
                            [
                                'label'=>'Institution name',
                                'attribute'=>'ppi_organization',
                                'value'=>(empty($institution->institution_name) >= 18) ? null : $institution->institution_name
                            ]
                        ],
                        'mode' => 'view',
                        'bordered' => true,
                        'striped' => false,
                        'condensed' => false,
                        'responsive' => true,
                        'hover' => true,
                        'panel' => [
                            'type' => DetailView::TYPE_WARNING,
                            'heading' => "<a href=\"$url\" style=\"color: black\"><h3 class=\"panel-title\"><i class=\"fas fa-search\"></i> $info </h3></a>",
                        ],
                        'enableEditMode' => false
                    ]);
                    echo "
                            </div>
                        </div>
                    </div>
                ";
                }
            }
        }
    ?>
</div>
<!-- /.container-fluid -->

