<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DetailKegiatan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Detail Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-kegiatan-view">

    <p>
        <?= Html::a('Ubah', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
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
            'id',
            'kode_kegiatan',
            'tahun',
            'lokasi',
            'target',
            'pagu',
            'sumber',
            'catatan',
            'prakiraan_target',
            'prakiraan_pagu',
            'username',
            'kode_skpd',
            'create_at',
            'save_status',
            'kategori',
            'file',
            'map',
        ],
    ]) ?>

</div>
