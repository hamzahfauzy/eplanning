<?php

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue layout-top-nav">

        <?php $this->beginBody() ?>
        <div class="wrapper">
            <header class="main-header">
                <?php
            NavBar::begin([
                'brandLabel' => Yii::$app->name,
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse',
                ],
            ]);
            $menuItems = [
               // ['label' => 'Home', 'url' => ['/site/index']],
              //  ['label' => 'Panduan', 'url' => ['/site/index']],
              //  ['label' => 'About Us', 'url' => ['/site/index']],
              //  ['label' => 'Contact', 'url' => ['/site/contact']],
            ];
            if (Yii::$app->user->isGuest) {
             //   $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Dashboard (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/dashboard/index'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>
            </header>

            <div class="content-wrapper">
                <div class="container">
                    <section class="content-header">
                        <?php if (isset($this->blocks['content-header'])) { ?>
                            <h1><?= $this->blocks['content-header'] ?></h1>
                        <?php } else { ?>
                            <h1>
                                <?php
                                if ($this->title !== null) {
                                    echo \yii\helpers\Html::encode($this->title);
                                } else {
                                    echo \yii\helpers\Inflector::camel2words(
                                            \yii\helpers\Inflector::id2camel($this->context->module->id)
                                    );
                                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                                }
                                ?>
                            </h1>
                        <?php } ?>

                        <?=
                        Breadcrumbs::widget(
                                [
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]
                        )
                        ?>
                    </section>
                    <section class="content">
                        <?= Alert::widget() ?>
                        <?= $content ?>
                    </section>
                </div>

                <footer class="main-footer">
                    <div class="container">
                    <div class="pull-right hidden-xs">
                        <b>Version</b> <?= Yii::$app->params['version'] ?>
                    </div>
                        <strong>Copyright &copy; <?= date('Y')?> <a href="http://asahankab.go.id">Aplikasi Referensi</a>. </strong> All rights reserved.                     </div>
                </footer>
            </div>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
