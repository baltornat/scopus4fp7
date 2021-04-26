<?php

use kartik\detail\DetailView;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

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
        ->andWhere(['>=', 'match_value', 0])
        ->orderBy(['project_author_match.match_value'=>SORT_DESC])
        ->limit(10)
        ->all();
    $mappings = \app\models\AuthorsMappingErcScopus::find()
        ->joinWith('projectPpi')
        ->where(['mapping_erc_scopus.erc_field'=>$model->erc_field])
        ->orderBy(['relevance'=>SORT_DESC])
        ->all();
    $subjects = array();
    $match_value_percentages = array();
    foreach($authors as $author){
        $matchValue = $author->projectAuthorMatch->match_value;
        $percentage = $matchValue * 100;
        $match_value_percentages[]=$percentage;
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

    <!-- Areas -->
    <div class="card shadow mb-4 border-bottom-warning">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardAreas" class="d-block card-header py-3 collapsed" data-toggle="collapse"
           role="button" aria-expanded="false" aria-controls="collapseCardAreas">
            <h6 class="h4 m-0 font-weight-bold text-primary">Show/hide relevance of all the areas with Erc (<?=$model->erc_field ?>)</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse" id="collapseCardAreas">
            <div class="card-body">
                <h6>If present, the light blue ones indicate the areas of the candidate authors listed below</h6>
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
                                    <div class=\"card mb-4 border-left-info border-bottom-info\">
                                        <div class=\"card-body\">
                            ";
                            $relValue = $mapping->relevance;
                            $perc = $relValue * 100;
                            echo "<div class=\"text-gray-700\">Area: $mapping->scopus_area</div>";
                            echo "
                                <div class=\"mb-1 text-gray-700\">Relevance: $perc%</div>
                                <div class=\"progress mb-4\">
                                    <div class=\"progress-bar bg-info\" role=\"progressbar\" style=\"width: $perc%\"
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
                    if($counter%3 != 0){
                        echo "
                            </div>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Project -->
    <div class="card shadow mb-4 border-bottom-warning">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardProject" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseCardProject">
            <h6 class="h4 m-0 font-weight-bold text-primary">Show/hide project data</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardProject">
            <div class="card-body">
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
                                    'value'=> function($model){
                                        if(isset($model->institution->institution_name)){
                                            return $model->institution->institution_name;
                                        }
                                        return null;
                                    }
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
                                'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-tasks\"></i> $this->title </h3>",
                            ],
                            'enableEditMode' => false
                        ]);
                        echo "<br>";
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Commands dashboard -->
    <div class="row">
        <?php if(!empty($authors)): ?>
            <!-- Show match threshold -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Set the match threshold value</div><br>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div class="col-xl-8 col-lg-7">
                                        <input type="range" class="custom-range" min="0" max="100" value="10" step="0.1" id="customRange1" oninput="changeColor('<?=implode("-", $match_value_percentages) ?>', this.value);"><br><br>
                                        <input type="text" id="textInput" value="" placeholder="10%" style="width: 80px;" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sliders-h fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <!-- Add new candidate -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Add new candidate</div><br>
                            <div class="col-xl-8 col-lg-7">
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= Html::a('Add', ['authors-scopus-author/create', 'project_ppi' => $model->id, 'erc_field' => $model->erc_field], ['class' => 'btn btn-primary']) ?></div>
                                <br><br>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-plus fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Candidates -->
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
                $url = \yii\helpers\Url::toRoute(['/authors-scopus-author/view', 'id' => $author->id]);
                $matchValue = $author->projectAuthorMatch->match_value;
                $percentage = $matchValue * 100;
                if($percentage>=10){
                    echo "
                        <div class=\"col-lg-4\">           
                            <div id=\"author$counter\" class=\"card shadow mb-4 border-bottom-success border-left-success\">
                                <div class=\"card-header py-3\">
                                    <a href=\"$url\">
                                        <h6 id=\"head$counter\" class=\"h4 m-0 font-weight-bold text-success\">$info <sup><i class=\"fas fa-search\"></i></sup></h6><br>
                                    </a>
                    ";
                }else{
                    echo "
                        <div class=\"col-lg-4\">           
                            <div id=\"author$counter\" class=\"card shadow mb-4 border-bottom-danger border-left-danger\">
                                <div class=\"card-header py-3\">
                                    <a href=\"$url\">
                                        <h6 id=\"head$counter\" class=\"h4 m-0 font-weight-bold text-danger\">$info <sup><i class=\"fas fa-search\"></i></sup></h6><br>
                                    </a>
                    ";
                }
                $form = ActiveForm::begin([
                    'action' =>['/authors-project-author-match/update','project_ppi'=>$model->id, 'author_scopus_id'=>$author->author_scopus_id]
                ]);
                if($percentage>=10){
                    echo Html::submitButton('Delete', ['data-confirm' => 'Are you sure you want to remove this candidate?', 'class' => 'btn btn-google btn-block', 'name' => 'match-button', 'id' => "match-button$counter", 'style' => 'background-color: #1cc88a']);
                    ActiveForm::end();
                    echo "
                        </div>
                            <div class=\"card-body\">
                                <div class=\"mb-1 text-gray-700\">Match value: $percentage%</div>
                                <div class=\"progress mb-4\">
                                    <div id=\"bar$counter\" class=\"progress-bar bg-success\" role=\"progressbar\" style=\"width: $percentage%\"
                                        aria-valuenow=\"$matchValue\" aria-valuemin=\"0\" aria-valuemax=\"1\">
                                    </div>
                                </div>
                            </div>
                    ";
                }else{
                    echo Html::submitButton('Delete', ['data-confirm' => 'Are you sure you want to remove this candidate?', 'class' => 'btn btn-google btn-block', 'name' => 'match-button', 'id' => "match-button$counter", 'style' => 'background-color: #e74a3b']);
                    ActiveForm::end();
                    echo "
                        </div>
                            <div class=\"card-body\">
                                <div class=\"mb-1 text-gray-700\">Match value: $percentage%</div>
                                <div class=\"progress mb-4\">
                                    <div id=\"bar$counter\" class=\"progress-bar bg-danger\" role=\"progressbar\" style=\"width: $percentage%\"
                                        aria-valuenow=\"$matchValue\" aria-valuemin=\"0\" aria-valuemax=\"1\">
                                    </div>
                                </div>
                            </div>
                    ";
                }
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


