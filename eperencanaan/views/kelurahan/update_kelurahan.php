<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaMusrenbangKelurahan */

$this->title = 'Edit Data Musrenbang Kelurahan: ' . $model->Kd_Musrenbang_Kelurahan;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Musrenbang_Kelurahan, 'url' => ['view', 'id' => $model->Kd_Musrenbang_Kelurahan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-musrenbang-kelurahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_kelurahan', [
        'model' => $model,
    ]) ?>

</div>
