<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DetailKegiatanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usulan Kegiatan';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detail-kegiatan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php //Html::a('Create Detail Kegiatan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
        foreach($dataProvider as $data){
    ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            <th>Nama Kegiatan</th>
            <th>Lokasi</th>
            <th>Target</th>
            <th>Pagu</th>
            <th>Sumber</th>
            <th>Catatan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td><?= $data['nama_kegiatan']; ?></td>
            <td><?= $data['lokasi']; ?></td>
            <td><?= $data['target']; ?></td>
            <td><?= $data['pagu']; ?></td>
            <td><?= $data['sumber']; ?></td>
            <td><?= $data['catatan']; ?></td>
            <td>Verifikasi | <?= Html::a('Edit', ['detail-kegiatan/update', 'id' => $data['id']], ['class' => 'btn btn-primary']) ?> <?= Html::a('Hapus', ['delete', 'id' => $data['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?></td>
        </tr>
        <tr>
            <td colspan='9'>
            &nbsp;
            </td>
        </tr>
        <tr>
            <td colspan='9'>
            <?= Html::a('Tambah Uraian', ['uraian-kegiatan/create', 'id' => $data['id']], ['class' => 'btn btn-primary']) ?>
<table class='table table-striped table-bordered'>
    <thead>
        <tr>
            <th>No</th>
            <th>Uraian</th>
            <th>Volume</th>
            <th>Satuan</th>
            <th>Harga Satuan</th>
            <th>Total Harga</th>
            <th>Keterangan</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $dataUraian = $this->context->getUraian($data['id']);
    $i=1;
    foreach($dataUraian as $duraian){
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?= $duraian['uraian']; ?></td>
            <td><?= $duraian['volume']; ?></td>
            <td><?= $duraian['satuan']; ?></td>
            <td><?= number_format($duraian['harga']); ?></td>
            <td><?= number_format($duraian['total']); ?></td>
            <td><?= $duraian['keterangan']; ?></td>
            <td><?= Html::a('Edit', ['uraian-kegiatan/update', 'id' => $duraian['id']], ['class' => 'btn btn-primary']) ?> <?= Html::a('Hapus', ['uraian-kegiatan/delete', 'id' => $duraian['id']], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        </td>
        </tr>
    <?php
    $i=$i+1;
    }
    ?>
    </tbody>
</table>
            </td>
        </tr>

    </tbody>
</table>
<?php
     }
    ?>
<br>
<br>
<br>
</div>
