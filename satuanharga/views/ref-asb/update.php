<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefAsb */
?>
<div class="ref-asb-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataAsb' => $dataAsb,
        'model2' => $model2,
        'Kd_Satuan' => $Kd_Satuan,
        'Kategori_Pekerjaan' => $Kategori_Pekerjaan,
        'Data_Asb2' => $Data_Asb2,
        'Data_Asb3' => $Data_Asb3,
        'Data_Asb4' => $Data_Asb4,
    ]) ?>

</div>
