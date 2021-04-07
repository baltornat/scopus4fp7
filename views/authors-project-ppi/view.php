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
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Authors</h1>
    <p class="mb-4">Here are shown all the authors that matched with the project searched</p>
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
            $counter = 0;
            foreach($authors as $author) {
                if($counter%3 == 0 || $counter==0){
                    echo "<div class=\"row\">";
                }
                $info = "Author ".$author->id." - ".$author->firstname." ".$author->lastname;
                $matchValue = $author->projectAuthorMatch->match_value;
                $percentage = $matchValue * 100;
                echo "
                    <div class=\"col-lg-4\">           
                        <div class=\"card shadow mb-4 border-bottom-warning\">
                            <div class=\"card-header py-3\">
                                <h6 class=\"m-0 font-weight-bold text-primary\">$info</h6>
                            </div>
                            <div class=\"card-body\">
                                <div class=\"mb-1 small\">Match value: $percentage%</div>
                                <div class=\"progress mb-4\">
                                    <div class=\"progress-bar\" role=\"progressbar\" style=\"width: $percentage%\"
                                        aria-valuenow=\"$matchValue\" aria-valuemin=\"0\" aria-valuemax=\"1\">
                                    </div>
                                </div>
                            </div>
                ";
                echo DetailView::widget([
                    'model' => $author,
                    'attributes' => [
                        //'projectAuthorMatch.match_value',
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


