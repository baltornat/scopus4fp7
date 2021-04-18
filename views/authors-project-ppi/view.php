<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectPpi */

$this->title = "Project number $model->id";

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Candidate authors</h1>
    <p class="mb-4">Here are shown all the authors that matched with the project searched</p>
    <?php
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                'erc_field',
                'funding_scheme',
                'call_year',
                'ppi_firstname',
                'ppi_lastname',
                [
                    'label'=>'Institution name',
                    'attribute' => 'ppi_organization',
                    'value'=>$model->institution->institution_name,
                ],
            ],
            'mode' => 'view',
            'bordered' => true,
            'striped' => false,
            'condensed' => false,
            'responsive' => true,
            'hover' => true,
            'panel' => [
                'type' => DetailView::TYPE_PRIMARY,
                'heading' => "<h3 class=\"panel-title\"><i class=\"glyphicon glyphicon-user\"></i> $this->title </h3>",
            ],
            'enableEditMode' => false
        ]);
        echo "<br>";
    ?>
    <?php
        $authors = \app\models\AuthorsScopusAuthor::find()
            ->joinWith('authorSubjectArea')
            ->joinWith('projectAuthorMatch')
            ->where(['scopus_author.project_ppi'=>$model->id])
            ->orderBy(['project_author_match.match_value'=>SORT_DESC])
            ->limit(10)
            ->all();
        if(empty($authors)){
            echo "<div class=\"alert alert-danger\"> No valid candidate authors found!</div>";
        }else{
            $counter = 0;
            foreach($authors as $author) {
                if($counter%3 == 0 || $counter==0){
                    echo "<div class=\"row\">";
                }
                $info = "Candidate author ".$author->id;
                $matchValue = $author->projectAuthorMatch->match_value;
                $percentage = $matchValue * 100;
                echo "
                    <div class=\"col-lg-4\">           
                        <div class=\"card shadow mb-4 border-bottom-warning\">
                            <div class=\"card-header py-3\">
                                <h6 class=\"h4 m-0 font-weight-bold text-primary\">$info</h6>
                            </div>
                            <div class=\"card-body\">
                                <div class=\"mb-1 text-gray-700\">Match value: $percentage%</div>
                                <div class=\"progress mb-4\">
                                    <div class=\"progress-bar\" role=\"progressbar\" style=\"width: $percentage%\"
                                        aria-valuenow=\"$matchValue\" aria-valuemin=\"0\" aria-valuemax=\"1\">
                                    </div>
                                </div>
                            </div>
                ";
                $areas = implode(', ', $author->getAuthorSubjectArea()->select(["CONCAT(area_short_name, ' (', area_frequency, ')') AS full_area"])->orderBy(['area_frequency'=>SORT_DESC])->column());
                echo DetailView::widget([
                    'model' => $author,
                    'attributes' => [
                        'author_scopus_id',
                        'firstname',
                        'lastname',
                        'affil_id',
                        'affil_name',
                        'affil_city',
                        'affil_country',
                        'num_documents',
                        'author_modality',
                        [
                            'label'=>'Areas (freq.)',
                            'value' => $areas
                        ],
                    ],
                    'mode' => 'view',
                    'bordered' => true,
                    'striped' => false,
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'enableEditMode' => false
                ]);
                echo "
                        </div>
                    </div>
                ";
                $counter++;
                if($counter%3 == 0) {
                    echo "</div>";
                }
            }
        }
    ?>
</div>
<!-- /.container-fluid -->


