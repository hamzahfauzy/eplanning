<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use eperencanaan\assets\DashboardAsset;
use dmstr\widgets\Alert;

DashboardAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title>E-Musrenbang <?= Html::encode($this->title) ?></title>
		<link href="img/logo1.png" rel="shortcut icon">
        <?php $this->head() ?>
    </head>
	<style>
	#side-menu.nav i.fa-fw {
		color:#333;
	}
	.modal-backdrop {
	  z-index: 1;
	}

	</style>
    <body>
        <?php $this->beginBody() ?>

        <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
