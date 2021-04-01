<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
              'class' => 'fixed-top navbar-expand-lg navbar-dark bg-dark',
            ],
        ]);
        $navItem = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];
        if(Yii::$app->user->isGuest){
            array_push($navItem, ['label' => 'Login', 'url' => ['/site/login']], ['label' => 'Sign up', 'url' => ['/site/signup']]);
        }elseif(Yii::$app->user->can('manageUser')){
            array_push($navItem, ['label' => 'Manage users', 'url' => ['/user/index']], ['label' => 'Projects', 'url' => ['/authors-project-ppi/index']], '<li>'. Html::beginForm(['/site/logout'], 'post'). Html::submitButton('Logout (' . Yii::$app->user->identity->email . ')',['class' => 'btn btn-link logout']). Html::endForm(). '</li>');
        }else{
            array_push($navItem, ['label' => 'Projects', 'url' => ['/authors-project-ppi/index']], '<li>'. Html::beginForm(['/site/logout'], 'post'). Html::submitButton('Logout (' . Yii::$app->user->identity->email . ')',['class' => 'btn btn-link logout']). Html::endForm(). '</li>');
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ml-auto'],
            'items' => $navItem,
        ]);
        NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'itemTemplate' => "\n\t<li class=\"breadcrumb-item\"><i>{link}</i></li>\n", // template for all links
            'activeItemTemplate' => "\t<li class=\"breadcrumb-item active\">{link}</li>\n", // template for the active link
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Università degli Studi di Milano - <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
