<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaPemda */

$this->title = 'Ubah Pemda';
$this->params['breadcrumbs'][] = ['label' => 'Pemda', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pemda-update">
	<div class="box-header">
		<h1 class="box-title"><?= Html::encode($this->title) ?></h1>
	</div>
	<div class="box-body">
		<div class="ta-pemda-create">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
