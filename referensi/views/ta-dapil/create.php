<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaDapil */

?>
<div class="ta-dapil-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataDapil' => $dataDapil,
        'dataProvinsi' => $dataProvinsi,
    ]) ?>
</div>
