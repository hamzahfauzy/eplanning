<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaForumLingkunganSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usulan Lingkungan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-forum-lingkungan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			'Nm_Permasalahan',
			['attribute' => 'Kd_Jalan',
			'format' => 'raw',
			 'label' => 'Jalan',
			 'value' => function($model, $key, $index)
			{   
                return /*$model->kdJalan->Nm_Jalan." ".$model->kdLink->Nm_Lingkungan." ".$model->kdKel->Nm_Kel." ".*/$model->kdKec->Nm_Kec." ".$model->kdKab->Nm_Kab
				." ".$model->kdProv->Nm_Prov;
				
            },
			],
			['attribute' => 'Volume',
			 'format' => 'raw',
			 'value' => function($model, $key, $index)
			{   
                return $model->Volume . " " . $model->kdSatuan->Uraian;
				
            },
			],
             
            

            ['class' => 'yii\grid\ActionColumn',
			'template' => '{edit1}{edit2}',
			'header' => 'Aksi',
			'buttons' => [
				'edit1' => function ($url, $model){
					return Html::a('Tambah',['tambah-lingkungan-ke-kelurahan', 'Tahun' => $model->Tahun, 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan,
					'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Nm_Permasalahan' => $model->Nm_Permasalahan, 'Volume' => $model->Volume, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran],['class' => 'btn btn-info']);
				},
				'edit2' => function ($url, $model){
					return Html::a('Lihat',['view-lingkungan','Tahun' => $model->Tahun, 'Kd_Benua' => $model->Kd_Benua, 'Kd_Benua_Sub' => $model->Kd_Benua_Sub, 'Kd_Benua_Sub_Negara' => $model->Kd_Benua_Sub_Negara, 'Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab, 'Kd_Kec' => $model->Kd_Kec, 'Kd_Kel' => $model->Kd_Kel, 'Kd_Urut_Kel' => $model->Kd_Urut_Kel, 'Kd_Lingkungan' => $model->Kd_Lingkungan, 'Kd_Jalan' => $model->Kd_Jalan, 'Kd_Urusan' => $model->Kd_Urusan,
					'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Klasifikasi' => $model->Kd_Klasifikasi, 'Nm_Permasalahan' => $model->Nm_Permasalahan, 'Volume' => $model->Volume, 'Kd_Satuan' => $model->Kd_Satuan, 'Kd_Sasaran' => $model->Kd_Sasaran],['class' => 'btn btn-info']);
				},
				],
			
			],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
