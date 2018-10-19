<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaPaguProgram */

$this->title = 'Create Ta Pagu Program';
$this->params['breadcrumbs'][] = ['label' => 'Ta Pagu Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$prog=array();
$bidang=array();
$unit=array();
$sub=array();
?>
<div class="ta-pagu-program-create">

    <?= $this->render('_form', [
        'model' => $model,
        'prog'=>$prog,
        'bidang'=>$bidang,
        'unit'=>$unit,
        'sub'=>$sub,
    ]) ?>

</div>
