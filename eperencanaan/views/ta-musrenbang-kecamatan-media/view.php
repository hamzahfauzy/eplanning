<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKecamatanMedia */

$this->title = $model->Kd_Musrenbang_Kecamatan;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kecamatan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kecamatan-media-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Kd_Musrenbang_Kecamatan' => $model->Kd_Musrenbang_Kecamatan, 'Kd_Media' => $model->Kd_Media], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Kd_Musrenbang_Kecamatan' => $model->Kd_Musrenbang_Kecamatan, 'Kd_Media' => $model->Kd_Media], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Musrenbang_Kecamatan',
            'Kd_Media',
        ],
    ]) ?>

</div>
