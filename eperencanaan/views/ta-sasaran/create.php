<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaSasaran */

?>
<div class="ta-sasaran-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataUrusan' => $dataUrusan,
        'dataBidang' => $dataBidang,
        'dataUnit' => $dataUnit,
        'dataSub' => $dataSub,
        'dataMisi' => $dataMisi,
    ]) ?>
</div>
