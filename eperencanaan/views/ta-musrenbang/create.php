<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->title = 'Tambah Usulan Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-create">
  

    <?= $this->render('_form', [
        'model' => $model,
         'NASbidangpem' =>$NASbidangpem,
        'NASsatuan'=> $NASsatuan,
        'NASrpjmd' => $NASrpjmd,
        'NASunit' => $NASunit,
       
    ]) ?>

</div>
