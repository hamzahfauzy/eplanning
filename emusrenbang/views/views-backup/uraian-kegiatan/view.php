<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UraianKegiatan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Uraian Kegiatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uraian-kegiatan-view">


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
            'kode_skpd',
            'tahun',
            'jenis',
            'uraian:ntext',
            'volume',
            'satuan',
            'harga',
            'jumlah',
            'total',
            'keterangan:ntext',
            'save_status',
            'username',
        ],
    ]) ?>

</div>
