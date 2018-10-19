<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaDapil */
?>
<div class="ta-dapil-update">

    <?= $this->render('_form', [
        'model' => $model,
        'dataDapil' => $dataDapil,
        'dataProvinsi' => $dataProvinsi,
        'dataKabupaten' => $dataKabupaten,
        'dataKecamatan' => $dataKecamatan,
    ]) ?>

</div>
