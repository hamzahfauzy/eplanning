<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LevelAplikasi */

$this->title = 'Ubah Level Aplikasi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Level Aplikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="level-aplikasi-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
