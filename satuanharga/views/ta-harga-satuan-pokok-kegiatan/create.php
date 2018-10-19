<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TaHargaSatuanPokokKegiatan */

$this->title = 'Create Ta Harga Satuan Pokok Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Harga Satuan Pokok Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-harga-satuan-pokok-kegiatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'Kd_Aset1' => $Kd_Aset1,
        'Kd_1'=>$Kd_1,
    ]) ?>

</div>
