<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaForumLingkunganMedia */

$this->title = 'Update Ta Forum Lingkungan Media: ' . $model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Ta Forum Lingkungan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Tahun, 'url' => ['view', 'Tahun' => $model->Tahun, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Media' => $model->Kd_Media]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-forum-lingkungan-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
