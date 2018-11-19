<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefHspk */
?>
<div class="ref-hspk-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataHspk' => $dataHspk,
        'dataHspk2' => $dataHspk2,
        'dataHspk3' => $dataHspk3,
        'dataSatuan' => $dataSatuan,
        'modelanak' => $modelanak,
        'dataSsh' => $dataSsh,
        'harga' => $harga,
    ]) ?>

</div>
