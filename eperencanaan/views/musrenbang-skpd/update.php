<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->title = 'Update Ta Musrenbang: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-musrenbang-update">

    <?= $this->render('_form', [
        'model' => $model,
		'NASbidangpem' =>$NASbidangpem,
        'NASsatuan'=> $NASsatuan,
        'NASrpjmd' => $NASrpjmd,
        'dataunit' => $dataunit,
		'unitpilihan'=>$unitpilihan,
		'RefKelurahan' => $RefKelurahan,	
    ]) ?>

</div>