<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbangKelurahanMedia */

$this->title = $model->Kd_Musrenbang_Kelurahan;
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbang Kelurahan Media', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-media-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Kd_Musrenbang_Kelurahan' => $model->Kd_Musrenbang_Kelurahan, 'Kd_Media' => $model->Kd_Media], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Kd_Musrenbang_Kelurahan' => $model->Kd_Musrenbang_Kelurahan, 'Kd_Media' => $model->Kd_Media], [
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
            'Kd_Musrenbang_Kelurahan',
            'Kd_Media',
        ],
    ]) ?>

</div>
