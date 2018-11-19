<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahan */



?>
<div class="ta-musrenbang-kelurahan-create">

    <h1><?= Html::encode($this->title) ?></h1>
		
    <?= $this->render('_form_kelurahan', [
        'kelurahan' => $kelurahan,
        'model' => $model,
        'NASsatuan' => $NASsatuan,
        'NASbidangpem' => $NASbidangpem,
        'NASrpjmd' => $NASrpjmd,
        'jalan' => $jalan,
    ]) ?>

</div>
