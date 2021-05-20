<?php
/* @var $this yii\web\View */

use practically\chartjs\Chart;
use yii\web\JsExpression;

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;

$subquery = \app\models\AuthorsProjectPpi::find()
    ->select(["project_ppi.id, SUM(CASE WHEN scopus_author.id is null THEN 0 ELSE 1 END) AS num_authors"])
    ->leftJoin('authors.scopus_author', 'project_ppi.id = scopus_author.project_ppi')
    ->groupBy(['project_ppi.id'])
    ->orderBy(['id'=>SORT_ASC]);
$query = \app\models\AuthorsProjectPpi::find()
    ->select(["avg(num_authors) AS mean"])
    ->from([$subquery])
    ->one();

$subquery2 = \app\models\AuthorsProjectAuthorMatch::find()
    ->select(["project_ppi, avg(match_value) AS mean_match_value"])
    ->groupBy(['project_ppi']);
$query2 = \app\models\AuthorsProjectAuthorMatch::find()
    ->select(["avg(mean_match_value) AS mean2"])
    ->from([$subquery2])
    ->one();
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Statistics</h1>
    <p class="mb-4">Here is shown some statistic data about the projects and the candidates</p>
    <!-- Statistics row 1 -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <!-- Bar Chart Projects/ERC field -->
            <div class="card shadow mb-4 border-bottom-warning">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Number of projects per ERC field</h6>
                </div>
                <div class="card-body">
                    <?=Chart::widget([
                        'type' => Chart::TYPE_BAR,
                        'datasets' => [
                            [
                                'query' => \app\models\AuthorsProjectPpi::find()
                                    ->select(["erc_field, COUNT(*) AS num_projects"])
                                    ->groupBy(['erc_field'])
                                    ->orderBy(['num_projects'=>SORT_DESC])
                                    ->createCommand(),
                                'labelAttribute' => 'erc_field',
                                'dataAttribute' => 'num_projects'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'scales' => [
                                'xAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'ERC field'
                                        ],
                                    ],
                                ],
                                'yAxes' => [
                                    [
                                        'ticks' => [
                                            'min' => 0
                                        ],
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Number of projects'
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <!-- Mean of candidates per project -->
            <div class="card shadow mb-4 border-bottom-warning">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Average number of candidates per project</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="text-align: center;">
                    <br>
                    <h1><code><?=round($query->mean, 2, PHP_ROUND_HALF_UP) ?></code></h1>
                    <br>
                </div>
            </div>
            <!-- Mean of match value between all the projects -->
            <div class="card shadow mb-4 border-bottom-warning">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Average match value of the candidate authors among all projects</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body" style="text-align: center;">
                    <br>
                    <h1><code><?=round($query2->mean2 *100, 2, PHP_ROUND_HALF_UP)?>%</code></h1>
                    <br>
                </div>
            </div>
        </div>
    </div>
    <hr><br>
    <!-- Statistics row 2 -->
    <div class="row">
        <div class="col-xl-4 col-lg-5">
            <!-- Doughnut Chart author_modalities -->
            <div class="card shadow mb-4 border-bottom-warning">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Number of scopus authors per author modality</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?=Chart::widget([
                        'type' => Chart::TYPE_DOUGHNUT,
                        'datasets' => [
                            [
                                'query' => \app\models\AuthorsScopusAuthor::find()
                                    ->select(["author_modality, COUNT(*) AS num_modality"])
                                    ->where(['<>','author_modality', 'null'])
                                    ->groupBy(['author_modality'])
                                    ->orderBy(['num_modality' => SORT_DESC])
                                    ->createCommand(),
                                'labelAttribute' => 'author_modality',
                                'dataAttribute' => 'num_modality'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => [
                                'display' => true,
                                'position' => 'right'
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
            <!-- Bar Chart Top 10 projects/candidates -->
            <div class="card shadow mb-4 border-bottom-warning">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top 10 projects with highest number of candidates</h6>
                </div>
                <div class="card-body">
                    <?=Chart::widget([
                        'type' => Chart::TYPE_BAR,
                        'datasets' => [
                            [
                                'query' => \app\models\AuthorsProjectPpi::find()
                                    ->select(["project_ppi.id, SUM(CASE WHEN scopus_author.id is null THEN 0 ELSE 1 END) AS num_authors"])
                                    ->leftJoin('authors.scopus_author', 'project_ppi.id = scopus_author.project_ppi')
                                    ->groupBy(['project_ppi.id'])
                                    ->orderBy(['num_authors'=>SORT_DESC])
                                    ->limit(10)
                                    ->createCommand(),
                                'labelAttribute' => 'id',
                                'dataAttribute' => 'num_authors'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'scales' => [
                                'xAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Project ppi'
                                        ],
                                    ],
                                ],
                                'yAxes' => [
                                    [
                                        'ticks' => [
                                            'min' => 0
                                        ],
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Number of candidates'
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4 border-bottom-warning">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Number of projects per call year</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <?=Chart::widget([
                        'type' => Chart::TYPE_LINE,
                        'datasets' => [
                            [
                                'query' => \app\models\AuthorsProjectPpi::find()
                                    ->select(["call_year, COUNT(*) AS num_projects2"])
                                    ->groupBy(['call_year'])
                                    ->orderBy(['call_year'=>SORT_ASC])
                                    ->createCommand(),
                                'labelAttribute' => 'call_year',
                                'dataAttribute' => 'num_projects2'
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'scales' => [
                                'xAxes' => [
                                    [
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Call year'
                                        ],
                                    ],
                                ],
                                'yAxes' => [
                                    [
                                        'ticks' => [
                                            'min' => 0
                                        ],
                                        'scaleLabel' => [
                                            'display' => true,
                                            'labelString' => 'Number of projects'
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
