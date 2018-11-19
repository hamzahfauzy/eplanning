<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RefKelurahan */
//  print_r($model->lingkungans);
?>
<div class="ref-kelurahan-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Provinsi','value' => $model->provinsi->Nm_Prov],
            ['label' => 'Kabupaten','value' => $model->kabupaten->Nm_Kab],
            ['label' => 'Kecamatan','value' => $model->kecamatan->Nm_Kec],
            ['label' => 'Kode Kelurahan','value' => $model->Kd_Urut],
            ['label' => 'Nama Kelurahan','value' => $model->Nm_Kel],
        ],
    ]) ?>

    <?= \yii\grid\GridView::widget([
        'dataProvider' => new yii\data\ArrayDataProvider([
            'key' => 'Nm_Lingkungan',
            'allModels'=> $model->lingkungans,
            ]),
        'filterModel' => ['Kd_Prov'=>$model->Kd_Prov,'Kd_Kab' => $model->Kd_Kab,
            'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel'=>$model->Kd_Kel, 'Kd_Urut_Kel'=>$model->Kd_Urut],
        'columns' => [
            ['class' => '\yii\grid\SerialColumn'],
            'Nm_Lingkungan'
        ]
    ]);

    ?>
</div>
