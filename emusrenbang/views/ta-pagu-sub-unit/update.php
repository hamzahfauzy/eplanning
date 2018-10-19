<?php

use yii\helpers\Html;
use common\models\RefUrusan;

/* @var $this yii\web\View */
/* @var $model common\models\TaPaguSubUnit */
$xTahun=Date('Y')+1;
//echo $xTahun;
$this->title = 'Ubah Pagu Sub Unit: ' . $xTahun;//$model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Pagu Sub Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub]];
$this->params['breadcrumbs'][] = 'Ubah';
?>
<div class="ta-pagu-sub-unit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
		'urusan' => RefUrusan::find()->select('Nm_Urusan')->indexBy('Kd_Urusan')->column(),
    ]) ?>

</div>
