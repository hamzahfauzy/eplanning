<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahan */



?>
<div class="ta-musrenbang-kelurahan-create">

    <?= $this->render('_form', [
        'model' => $model,
         'NASbidangpem' =>$NASbidangpem,
        'NASsatuan'=> $NASsatuan,
        'NASrpjmd' => $NASrpjmd,
        'dataunit' => $dataunit,
        'dapil' =>$dapil,
        'Kd_Dewan' => $Kd_Dewan
       
    ]) ?>

</div>