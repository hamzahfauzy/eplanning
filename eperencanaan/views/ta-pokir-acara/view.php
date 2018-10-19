<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaPokirAcara */

$this->title = $model->Kd_User;
$this->params['breadcrumbs'][] = ['label' => 'Ta Pokir Acaras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-pokir-acara-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Kd_User], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Kd_User], [
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
            'Tahun',
            'Kd_User',
            'Waktu_Unduh_Absen',
            'Waktu_Unduh_Berita_Acara',
            'Waktu_Mulai',
            'Waktu_Selesai',
            'Masa_Reses',
            'Nama_Tempat:ntext',
            'Nama_Tempat2:ntext',
            'Nama_Tempat3:ntext',
            'Alamat:ntext',
            'Jumlah_Peserta',
        ],
    ]) ?>

</div>
