<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaTujuan */

$this->title = 'Tambah Rencana Strategis Tujuan '.( date('Y')+1 );
$this->params['breadcrumbs'][] = ['label' => 'Rencana Strategis Tujuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-tujuan-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataMisi' => $dataMisi,
    ]) ?>

</div>
