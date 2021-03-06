<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/img/europe_logo.png']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body id="page-top">
<?php $this->beginBody() ?>

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=Yii::$app->homeUrl ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-globe-europe"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Scopus <sup>4fp7</sup></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider my-0">
        <?php
        $manageUsersUrl = \yii\helpers\Url::to(['/user/index']);
        if(Yii::$app->user->can('manageUser')){
            echo "
                <!-- Divider -->
                <hr class=\"sidebar-divider\">
                <!-- Heading -->
                <div class=\"sidebar-heading\">
                    Admin
                </div>";
            if($this->title == "Users"){
                echo "<li class=\"nav-item active\">";
            }else{
                echo "<li class=\"nav-item\">";
            }
            # Nav Item - Manage Users
            echo"
                    <a class=\"nav-link\" href=\"".$manageUsersUrl."\">
                        <i class=\"fas fa-fw fa-cog\"></i>
                        <span>Manage users</span></a>
                </li>
            ";
        }
        ?>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <?php
        $loginUrl = \yii\helpers\Url::to(['/site/index']);
        $projectsUrl = \yii\helpers\Url::to(['/authors-project-ppi/index']);
        $authorsUrl = \yii\helpers\Url::to(['/authors-scopus-author/index']);
        $statisticsUrl = \yii\helpers\Url::to(['/statistics/index']);
        if(Yii::$app->user->isGuest){
            echo "
                <!-- Heading -->
                <div class=\"sidebar-heading\">
                    Interface
                </div>";
            if($this->title == "Login"){
                echo "<li class=\"nav-item active\">";
            }else{
                echo "<li class=\"nav-item\">";
            }
            # Nav Item - Login
            echo"
                    <a class=\"nav-link\" href=\"".$loginUrl."\">
                        <i class=\"fas fa-user fa-sm fa-fw\"></i>
                        <span>Login</span></a>
                </li>";
        }else{
            echo "
                <!-- Heading -->
                <div class=\"sidebar-heading\">
                    Manager
                </div>";
            if($this->title == "Projects"){
                echo "<li class=\"nav-item active\">";
            }else{
                echo "<li class=\"nav-item\">";
            }
            # Nav Item - Projects
            echo"
                    <a class=\"nav-link\" href=\"".$projectsUrl."\">
                        <i class=\"fas fa-fw fa-table\"></i>
                        <span>Manage projects</span></a>
                </li>
            ";
            if($this->title == "Candidate authors"){
                echo "<li class=\"nav-item active\">";
            }else{
                echo "<li class=\"nav-item\">";
            }
            # Nav Item - Candidates
            echo"
                    <a class=\"nav-link\" href=\"".$authorsUrl."\">
                        <i class=\"fas fa-users\"></i>
                        <span>Manage candidates</span></a>
                </li>
            ";
            if($this->title == "Statistics"){
                echo "<li class=\"nav-item active\">";
            }else{
                echo "<li class=\"nav-item\">";
            }
            # Nav Item - Statistics
            echo"
                    <a class=\"nav-link\" href=\"".$statisticsUrl."\">
                        <i class=\"fas fa-chart-bar\"></i>
                        <span>Statistics</span></a>
                </li>
            ";
        }
        ?>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
        <!-- Sidebar Message scopus -->
        <div class="sidebar-card">
            <img class="sidebar-card-illustration mb-2" src="/img/undraw_Tabs_re_a2bd.svg" alt="">
            <p class="text-center mb-2"><strong>Scopus</strong> is the world's largest abstract and citation database of peer-reviewed research literature. </p>
            <a class="btn btn-success btn-sm" href="https://www.scopus.com/freelookup/form/author.uri?zone=TopNavBar&origin=NO%20ORIGIN%20DEFINED">Author Search</a>
        </div>
        <!-- Sidebar Message elsevier -->
        <div class="sidebar-card">
            <img class="sidebar-card-illustration mb-2" src="/img/undraw_developer_activity_bv83.svg" alt="">
            <p class="text-center mb-2"><strong>Elsevier</strong> is a leader in information and analytics for customers across the global research and health ecosystems. </p>
            <a class="btn btn-success btn-sm" href="https://dev.elsevier.com/">Developer Portal</a>
        </div>
    </ul>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow border-bottom-primary">
                <h2>Scopus <sup>4FP7</sup></h2>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <?php
                    if(!Yii::$app->user->isGuest){
                        $id = Yii::$app->user->getId();
                        echo "
                            <div class=\"topbar-divider d-none d-sm-block\"></div>
                            <!-- Nav Item - User Information -->
                            <li class=\"nav-item dropdown no-arrow\">
                                <a class=\"nav-link dropdown-toggle\" id=\"userDropdown\" role=\"button\"
                                   data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                    <span class=\"mr-2 d-none d-lg-inline text-gray-600\">".Yii::$app->user->identity->name." ".Yii::$app->user->identity->surname."</span>
                                    <img class=\"img-profile rounded-circle\"
                                         src=\"/img/undraw_profile.svg\">
                                </a>
                                <!-- Dropdown - User Information -->
                                <div class=\"dropdown-menu dropdown-menu-right shadow animated--grow-in\"
                                     aria-labelledby=\"userDropdown\">
                                    <a class=\"dropdown-item\" href=".\yii\helpers\Url::to(['/user/info', 'id' => $id]).">
                                        <i class=\"fas fa-user fa-sm fa-fw mr-2 text-gray-400\"></i>
                                        Profile
                                    </a>
                                    <a class=\"dropdown-item\" href=".\yii\helpers\Url::to(['/user/password', 'id' => $id]).">
                                        <i class=\"fas fa-cogs fa-sm fa-fw mr-2 text-gray-400\"></i>
                                        Change password
                                    </a>
                                    <a class=\"dropdown-item\" role=\"button\" data-toggle=\"modal\" data-target=\"#logoutModal\">
                                        <i class=\"fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400\"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        ";
                    }
                    ?>
                </ul>
            </nav>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <?= Breadcrumbs::widget([
                    'itemTemplate' => "\n\t<li class=\"breadcrumb-item\"><i>{link}</i></li>\n", // template for all links
                    'activeItemTemplate' => "\t<li class=\"breadcrumb-item active\">{link}</li>\n", // template for the active link
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= $content ?>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Universit?? degli Studi di Milano - <?= date('Y') ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?=\yii\helpers\Url::to(['/site/logout']) ?>" data-method='post'>Logout</a>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>