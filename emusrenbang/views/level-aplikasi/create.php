<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LevelAplikasi */

$this->title = 'Tambah Level Aplikasi';
$this->params['breadcrumbs'][] = ['label' => 'Level Aplikasi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-aplikasi-create">

    <?= $this->render('_form', [
        'model' => $model,
        'data' => $data,
    ]) ?>

</div>
