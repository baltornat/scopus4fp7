<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
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
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Scopus <sup>4fp7</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Home -->
        <?php
            if($this->title == "Scopus"){
                echo "<li class=\"nav-item active\">";
            }else{
                echo "<li class=\"nav-item\">";
            }
        ?>
            <a class="nav-link" href="<?=\yii\helpers\Url::to(['/site/index']) ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span></a>
        </li>

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
            $loginUrl = \yii\helpers\Url::to(['/site/login']);
            $signupUrl = \yii\helpers\Url::to(['/site/signup']);
            $projectsUrl = \yii\helpers\Url::to(['/authors-project-ppi/index']);
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
                if($this->title == "Sign up"){
                    echo "<li class=\"nav-item active\">";
                }else{
                    echo "<li class=\"nav-item\">";
                }
                # Nav Item - Signup
                echo"
                        <a class=\"nav-link\" href=\"".$signupUrl."\">
                            <i class=\"fas fa-user fa-sm fa-fw\"></i>
                            <span>Signup</span></a>
                    </li>
                ";
            }else{
                echo "
                    <!-- Heading -->
                    <div class=\"sidebar-heading\">
                        Manager
                    </div>";
                if($this->title == "Authors Project Ppis"){
                    echo "<li class=\"nav-item active\">";
                }else{
                    echo "<li class=\"nav-item\">";
                }
                # Nav Item - Projects
                echo"
                        <a class=\"nav-link\" href=\"".$projectsUrl."\">
                            <i class=\"fas fa-fw fa-table\"></i>
                            <span>Projects</span></a>
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

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow border-bottom-primary">
                <h2>Scopus Web-App</h2>
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <?php
                        if(!Yii::$app->user->isGuest){
                            echo "
                                <div class=\"topbar-divider d-none d-sm-block\"></div>
                                <!-- Nav Item - User Information -->
                                <li class=\"nav-item dropdown no-arrow\">
                                    <a class=\"nav-link dropdown-toggle\" id=\"userDropdown\" role=\"button\"
                                       data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                        <span class=\"mr-2 d-none d-lg-inline text-gray-600\">".Yii::$app->user->identity->name." ".Yii::$app->user->identity->surname."</span>
                                        <img class=\"img-profile rounded-circle\"
                                             src=\"img/undraw_profile.svg\">
                                    </a>
                                    <!-- Dropdown - User Information -->
                                    <div class=\"dropdown-menu dropdown-menu-right shadow animated--grow-in\"
                                         aria-labelledby=\"userDropdown\">
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
                    <span>Copyright &copy; Università degli Studi di Milano - <?= date('Y') ?></span>
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
                    <span aria-hidden="true">×</span>
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