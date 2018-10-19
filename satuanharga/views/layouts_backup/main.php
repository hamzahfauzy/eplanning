<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use satuanharga\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="page-container list-menu-view">
    <!--Leftbar Start Here -->
    <div class="left-aside desktop-view">
        <?php include "logo.php" ?>
        <?php include "navigation.php" ?>
    </div>
    <div class="page-content">
        <?php include "header.php" ?>
      
        <div class="main-container">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-breadcrumb-wrap">
                                <div class="page-breadcrumb-info">
                                    <h2 class="breadcrumb-titles">
                                        <?php
                                            if ($this->title !== null) {
                                                echo Html::encode($this->title)." ";
                                            }
                                            if ($this->title !== null) {
                                                echo " <small> ";
                                          //      echo Html::encode($this->params['subtitle']);
                                                echo "</small>";
                                            }
                                        ?>
                                        
                                    </h2>
                                    <?=
                                        Breadcrumbs::widget(
                                            [
                                                'homeLink' => ['label' => 'Dashboard',
                                                    'url' => 'index.php?r=lingkungan/index' ],
                                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                            ]
                                        ) 
                                    ?>
                                    <!--
                                    <ul class="list-page-breadcrumb">
                                        <li>
                                            <a href="#">Beranda</a>
                                        </li>
                                        <li class="active-page"> Formulir usulan</li>
                                    </ul>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?= $content; ?>
            </div>
        </div>
        <?php include "footer.php" ?>
    </div>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
