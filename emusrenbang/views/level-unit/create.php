<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LevelUnit */

$this->title = 'Tambah Level Unit';
$this->params['breadcrumbs'][] = ['label' => 'Level Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="level-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
