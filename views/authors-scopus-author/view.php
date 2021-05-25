<?php

use kartik\detail\DetailView;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\AuthorsScopusAuthor */
/* @var $searchModel app\models\PublicationsPublicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $project */
/* @var $match */

$this->title = "Candidate "."$model->author_scopus_id";
$this->params['breadcrumbs'][] = ['label' => 'Candidate authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Candidate author <strong><?=$model->firstname?> <?=$model->lastname?></strong></h1>
    <p class="mb-4">Here is shown all data about the specified candidate author</p>

    <!-- Content Row -->
    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Candidate -->
            <div class="card shadow mb-4 border-bottom-warning">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardCandidate" class="d-block card-header py-3" data-toggle="collapse"
                   role="button" aria-expanded="true" aria-controls="collapseCardCandidate">
                    <h6 class="h4 m-0 font-weight-bold text-primary">Show/hide candidate data</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardCandidate">
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
                                        'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-user\"></i> Author Scopus ID: $model->author_scopus_id </h3>",
                                        'before' => false,
                                        'after' => false,
                                    ],
                                    'enableEditMode' => false
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Column -->
        <div class="col-lg-6 mb-4">
            <!-- Project -->
            <?php
                if($match->match_value < 0){
                    echo "<div class=\"alert alert-danger\"> Match value < 0 for this candidate! </div>";
                }else{
                    if(empty($project)){
                        echo "<div class=\"alert alert-danger\"> No projects found for this candidate!</div>";
                    }else{
                        $info = "Project ID: ".$project->ppiOrganization->p_id;
                        $url = \yii\helpers\Url::toRoute(['/authors-project-ppi/view', 'id' => $project->id]);
                        echo "
                            <div class=\"card shadow mb-4 border-bottom-warning\">                           
                                <a href=\"#collapseCardProject\" class=\"d-block card-header py-3\" data-toggle=\"collapse\"
                                   role=\"button\" aria-expanded=\"true\" aria-controls=\"collapseCardProject\">
                                    <h6 class=\"h4 m-0 font-weight-bold text-primary\">Show/hide project data</h6>
                                </a>
                                <div class=\"collapse show\" id=\"collapseCardProject\">
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
                                    'label'=>'Organization',
                                    'attribute'=>'ppi_organization',
                                    'value'=>(empty($project->ppiOrganization->ppi_organization) >= 18) ? null : $project->ppiOrganization->ppi_organization
                                ]
                            ],
                            'mode' => 'view',
                            'bordered' => true,
                            'striped' => false,
                            'condensed' => false,
                            'responsive' => true,
                            'hover' => true,
                            'panel' => [
                                'type' => DetailView::TYPE_PRIMARY,
                                'heading' => "<a href=\"$url\" style=\"color: white\"><h3 class=\"panel-title\"><i class=\"fas fa-search\"></i> $info </h3></a>",
                                'before' => false,
                                'after' => false,
                            ],
                            'enableEditMode' => false
                        ]);
                        echo "
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                    }
                }
            ?>
        </div>
    </div>
    <!-- Publications -->
    <div class="card shadow mb-4 border-bottom-warning">
        <!-- Card Header - Accordion -->
        <a href="#collapseCardPublications" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseCardPublications">
            <h6 class="h4 m-0 font-weight-bold text-primary">Show/hide all the publications for the project (<?=$project->ppiOrganization->p_id ?>) and the author <strong><?=$model->firstname?> <?=$model->lastname?></strong> (<?=$model->author_scopus_id ?>)</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseCardPublications">
            <div class="card-body">
                <div class="table-responsive">
                    <?php
                    $gridColumns = [
                        [
                            'class' => 'kartik\grid\SerialColumn',
                            'width' => '20px',
                        ],
                        'eid',
                        [
                            'attribute' => 'title',
                            'format' => 'raw',
                        ],
                        'citedby',
                        'pubdate',
                        [
                            'class' => 'kartik\grid\ExpandRowColumn',
                            'value' => function ($model, $key, $index, $column) {
                                return GridView::ROW_COLLAPSED;
                            },
                            'detail' => function ($data) {
                                return Yii::$app->controller->renderPartial('_authors', [
                                   'authors' => $data->authors,
                                ]);
                            }
                        ],
                    ];
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'filename' => 'publications-grid-export',
                        'clearBuffers' => true,
                        'batchSize' => 20,
                        'exportConfig' => [
                            ExportMenu::FORMAT_PDF => false
                        ],
                        'columns' => [
                            [
                                'class' => 'kartik\grid\SerialColumn',
                                'exportMenuStyle' => [ // format the serial column cells
                                    'fill' => [
                                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                        'color' => ['argb' => 'FFE5E5E5']
                                    ]
                                ]
                            ],
                            'id',
                            'eid',
                            'doi',
                            'title',
                            'citedby',
                            'issn',
                            'eissn',
                            'pubdate',
                            'pubdate_text',
                            'pubname',
                            'pubtype',
                            'funding_agency_acronym',
                            'funding_agency_id',
                            'funding_agency_name',
                            'citedby_link',
                            'author_scopus_id',
                            'project_ppi',
                            [
                                'label' => 'Authors (authid@authname@afid@afname@afcity@afcountry)',
                                'attribute' => 'authors',
                            ],
                            [
                                'label' => 'Content language',
                                'attribute' => 'publicationsAbstract.language',
                            ],
                            'publicationsAbstract.content',
                            [
                                'label' => 'Keywords (keyword@language)',
                                'attribute' => 'keywords',
                            ],
                        ],
                        'dropdownOptions' => [
                            'label' => 'Export All',
                            'class' => 'btn btn-outline-secondary'
                        ]
                    ]);
                    echo "<br><br>";
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                        'pager' => [
                            'firstPageLabel' => 'First',
                            'lastPageLabel'  => 'Last'
                        ],
                        'toolbar' => false,
                        'pjax' => true,
                        'bordered' => true,
                        'striped' => false,
                        'condensed' => false,
                        'responsive' => true,
                        'hover' => true,
                        'panel' => [
                            'type' => GridView::TYPE_PRIMARY,
                            'heading' => "<h3 class=\"panel-title\"><i class=\"fas fa-book\"></i> Publications</h3>",
                            'after' => false,
                            'before' => false
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

