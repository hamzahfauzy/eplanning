<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaPaguUnit */

$this->title = 'Tambah Ta Pagu Unit';
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$bidang=array();
$unit=array();
?>
<div class="ta-pagu-unit-create">

    <?= $this->render('_form', [
        'model' => $model,
        'bidang'=>$bidang,
        'unit'=>$unit,
    ]) ?>

</div>
