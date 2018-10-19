<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdProgramPrioritas */
?>
<div class="ta-rpjmd-program-prioritas-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataMisi' => $dataMisi,
        'dataTujuan' => $dataTujuan,
        'dataSasaran' => $dataSasaran,
        'dataPrioritas' => $dataPrioritas,
        'dataProgram' => $dataProgram,
    ]) ?>

</div>
