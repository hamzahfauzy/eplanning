<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKecamatanMedia */

$this->title = 'Update Ta Musrenbang Kecamatan Media: ' . $model->Kd_Musrenbang_Kecamatan;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kecamatan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Musrenbang_Kecamatan, 'url' => ['view', 'Kd_Musrenbang_Kecamatan' => $model->Kd_Musrenbang_Kecamatan, 'Kd_Media' => $model->Kd_Media]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-musrenbang-kecamatan-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
