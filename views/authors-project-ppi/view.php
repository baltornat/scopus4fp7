<?php

use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsProjectPpi */

$this->title = "Project number $model->id";

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!-- Initial queries -->
<?php
    $authors = \app\models\AuthorsScopusAuthor::find()
        ->joinWith('authorSubjectArea')
        ->joinWith('projectAuthorMatch')
        ->where(['scopus_author.project_ppi'=>$model->id])
        ->orderBy(['project_author_match.match_value'=>SORT_DESC])
        ->limit(10)
        ->all();
    $mappings = \app\models\AuthorsMappingErcScopus::find()
        ->joinWith('projectPpi')
        ->where(['mapping_erc_scopus.erc_field'=>$model->erc_field])
        ->orderBy(['relevance'=>SORT_DESC])
        ->all();
    $subjects = array();
    foreach($authors as $author){
        $areas = $author->getAuthorSubjectArea()->select(['area_short_name'])->column();
        foreach($areas as $area){
            if(!in_array($area, $subjects)){
                $subjects[]=$area;
            }
        }
    }
    $subjectsNotPresent = array();
    $areasNotPresent = $model->getMappingErcScopus()->select(['scopus_area'])->column();
    foreach($areasNotPresent as $area){
        if(!in_array($area, $subjectsNotPresent) && !in_array($area, $subjects)){
            $subjectsNotPresent[]=$area;
        }
    }
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800">Candidate authors</h1>
    <p class="mb-4">In this page you can check the candidates authors for the selected project. You can also see the relevance of all the areas with the Erc field specified by the project.</p>
    <a href="#areas" class="btn btn-danger btn-icon-split" data-toggle="collapse" aria-expanded="false" aria-controls="areas">
                        <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                        </span>
        <span class="text">Show/hide areas</span>
    </a>
    <br><br>

    <div class="collapse" id="areas">
        <div class="card shadow mb-4 border-bottom-warning">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Relevance of all the areas with Erc (<?=$model->erc_field ?>). If present, the green ones indicate the areas of the candidate authors listed below </h6>
            </div>
            <div class="card-body">
                <?php
                $counter = 0;
                foreach($mappings as $mapping) {
                    if(in_array($mapping->scopus_area, $subjectsNotPresent)){
                        if($counter%3 == 0){
                            echo "
                                <div class=\"row\">
                            ";
                        }
                        echo "
                            <!-- Mapping erc scopus not present -->
                            <div class=\"col-lg-4\">
                                <div class=\"card mb-4 border-left-danger\">
                                    <div class=\"card-body\">
                        ";
                        $relValue = $mapping->relevance;
                        $perc = $relValue * 100;
                        echo "<div class=\"text-gray-700\">Area: $mapping->scopus_area</div>";
                        echo "
                            <div class=\"mb-1 text-gray-700\">Relevance: $perc%</div>
                            <div class=\"progress mb-4\">
                                <div class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: $perc%\"
                                    aria-valuenow=\"$relValue\" aria-valuemin=\"0\" aria-valuemax=\"1\">
                                </div>
                            </div>
                        ";
                        $counter++;
                        echo "
                                    </div>
                                </div>
                            </div>
                        ";
                        if($counter%3 == 0){
                            echo "
                                </div>
                            ";
                        }
                    }
                    if(in_array($mapping->scopus_area, $subjects)){
                        if($counter%3 == 0){
                            echo "
                                <div class=\"row\">
                            ";
                        }
                        echo "
                            <!-- Mapping erc scopus not present -->
                            <div class=\"col-lg-4\">
                                <div class=\"card mb-4 border-left-success\">
                                    <div class=\"card-body\">
                        ";
                        $relValue = $mapping->relevance;
                        $perc = $relValue * 100;
                        echo "<div class=\"text-gray-700\">Area: $mapping->scopus_area</div>";
                        echo "
                            <div class=\"mb-1 text-gray-700\">Relevance: $perc%</div>
                            <div class=\"progress mb-4\">
                                <div class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: $perc%\"
                                    aria-valuenow=\"$relValue\" aria-valuemin=\"0\" aria-valuemax=\"1\">
                                </div>
                            </div>
                        ";
                        $counter++;
                        echo "
                                    </div>
                                </div>
                            </div>
                        ";
                        if($counter%3 == 0){
                            echo "
                                </div>
                            ";
                        }
                    }
                }
                echo "
                    </div>
                ";
                if($counter%3 != 0){
                    echo "
                        </div>
                    ";
                }
                ?>
            </div>
        </div>

    <div class="table-responsive">
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
    </div>

    <?php
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


