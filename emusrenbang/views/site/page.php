<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
	<div class="col-md-12">
        <div class="statis_page">
		  <?= $model->content; ?>
        </div>
	</div>
</div>
