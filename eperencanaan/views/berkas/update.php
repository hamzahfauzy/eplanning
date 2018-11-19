<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TaMusrenbangKelurahanMedia */

$this->title = 'Update Ta Musrenbang Kelurahan Media: ' . $model->Kd_Media;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Kd_Media, 'url' => ['view', 'id' => $model->Kd_Media]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ta-musrenbang-kelurahan-media-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
