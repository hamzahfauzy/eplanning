<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahanMedia */

$this->title = 'Update Ta Musrenbang Kelurahan Media: ' . $model->Kd_Musrenbang_Kelurahan;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Musrenbang_Kelurahan, 'url' => ['view', 'Kd_Musrenbang_Kelurahan' => $model->Kd_Musrenbang_Kelurahan, 'Kd_Media' => $model->Kd_Media]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-musrenbang-kelurahan-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
