<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaSasaran */

$this->title = 'Tambah Rencana Strategis Sasaran';
$this->params['breadcrumbs'][] = ['label' => 'Data Sasaran', 'url' => ['index']];
$this->params['breadcrumbs'][] = "Tambah";
?>
<div class="ta-sasaran-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataMisi' => $dataMisi,
    ]) ?>

</div>
