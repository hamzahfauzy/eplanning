<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahan */



?>
<div class="ta-musrenbang-kelurahan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'NASsatuan'=>$NASsatuan,
        'NASbidangpem'=>$NASbidangpem,
        'NASrpjmd'=>$NASrpjmd,
		'ZULRefLingkungan' => $ZULRefLingkungan,
		'lingkungan' => $lingkungan,

    ]) ?>

</div>
