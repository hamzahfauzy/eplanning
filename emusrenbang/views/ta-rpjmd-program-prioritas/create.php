<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdProgramPrioritas */

?>
<div class="ta-rpjmd-program-prioritas-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataMisi' => $dataMisi,
        'dataPrioritas' => $dataPrioritas,
        'dataProgram' => $dataProgram,
    ]) ?>
</div>
