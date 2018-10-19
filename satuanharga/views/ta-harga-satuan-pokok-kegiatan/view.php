<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TaHargaSatuanPokokKegiatan */

$this->title = $model->Kd_Benua;
$this->params['breadcrumbs'][] = ['label' => 'Ta Harga Satuan Pokok Kegiatans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-harga-satuan-pokok-kegiatan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2, 'Kd_Aset3' => $model->Kd_Aset3, 'Kd_Aset4' => $model->Kd_Aset4, 'Kd_Aset5' => $model->Kd_Aset5, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3, 'Kd_Satuan' => $model->Kd_Satuan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Kd_Aset1' => $model->Kd_Aset1, 'Kd_Aset2' => $model->Kd_Aset2, 'Kd_Aset3' => $model->Kd_Aset3, 'Kd_Aset4' => $model->Kd_Aset4, 'Kd_Aset5' => $model->Kd_Aset5, 'Kd_1' => $model->Kd_1, 'Kd_2' => $model->Kd_2, 'Kd_3' => $model->Kd_3, 'Kd_Satuan' => $model->Kd_Satuan], [
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
            'Kd_Benua',
            'Kd_Benua_Sub',
            'Kd_Benua_Sub_Negara',
            'Kd_Prov',
            'Kd_Kab',
            'Kd_Klasifikasi',
            'Kd_Aset1',
            'Kd_Aset2',
            'Kd_Aset3',
            'Kd_Aset4',
            'Kd_Aset5',
            'Kd_1',
            'Kd_2',
            'Kd_3',
            'Kd_Satuan',
        ],
    ]) ?>

</div>
