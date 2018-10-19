<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaTujuan */

?>
<div class="ta-tujuan-create">
    <?= $this->render('_form', [
        'model' => $model,
            'dataUrusan' => $dataUrusan,
            'dataBidang' => $dataBidang,
            'dataUnit' => $dataUnit,
            'dataSub' => $dataSub,
            'dataMisi' => $dataMisi,

    ]) ?>
</div>
