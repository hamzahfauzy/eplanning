<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RefSsh */

?>
<div class="ref-ssh-create">
    <?= $this->render('_form', [
        'model' => $model,
        'dataSsh' => $dataSsh,
        'dataSatuan'=> $dataSatuan,
        'Data_Ssh2' => $Data_Ssh2,
        'Data_Ssh3' => $Data_Ssh3,
        'Data_Ssh4' => $Data_Ssh4,
        'Data_Ssh5' => $Data_Ssh5,
    ]) ?>
</div>
