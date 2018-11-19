<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaMusrenbangKelurahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Musrenbang Kelurahan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-musrenbang-kelurahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
    </p>

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
                return /*$model->kdJalan->Nm_Jalan." ".$model->kdLink->Nm_Lingkungan." ".*/$model->kdKel->Nm_Kel." ".$model->kdKec->Nm_Kec." ".$model->kdKab->Nm_Kab
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
             ['attribute' => 'Kd_Status',
			 'format' => 'raw',
			 'label' => 'Status',
			 'value' => function($model, $key, $index)
			{   
                if($model->Kd_Status == '5'){
                    return Html::label('Belum Disurvey', [],['class' => 'label label-warning']);
                }
                else if($model->Kd_Status == '4'){   
                    return  Html::label('Sudah Disurvey', [],['class' => 'label label-info']);
                }
				
            },
				
			 ],

            ['class' => 'yii\grid\ActionColumn',
			'template' => '{edit1}',
			'header' => 'Ubah Status',
			'buttons' => [
				'edit1' => function ($url, $model){
					if ($model->Kd_Status == '5')
						return Html::a('Ubah',['upload', 'id'=>$model->Kd_Musrenbang_Kelurahan],['class'=>'btn btn-info btn-sm']);
					else
						return Html::a('Ubah',['upload', 'id'=>$model->Kd_Musrenbang_Kelurahan],['class'=>'btn btn-info btn-sm', 'disabled' => 'disabled']);
				},
				
				],
			
			
			],
			
			['class' => 'yii\grid\ActionColumn',
			'template' => '{edit1}',
			'header' => 'Edit Redaksi',
			'buttons' => [
				'edit1' => function ($url, $model){
					
						return Html::a('Edit Redaksi',['update-kelurahan', 'id'=>$model->Kd_Musrenbang_Kelurahan],['class'=>'btn btn-success btn-sm']);
					
				},
				
				],
			
			
			],
			
			['class' => 'yii\grid\ActionColumn',
			'template' => '{edit1}',
			'header' => 'Lihat',
			'buttons' => [
				'edit1' => function ($url, $model){
						return Html::a('Lihat',['view-kelurahan', 'id'=>$model->Kd_Musrenbang_Kelurahan],['class'=>'btn btn-danger btn-sm']);
					
				},
				
				],
			
			
			],
			['class' => 'yii\grid\ActionColumn',
			'template' => '{edit1}',
			'header' => 'Edit Berkas',
			'buttons' => [
				'edit1' => function ($url, $model){
						if ($model->Kd_Status == '4')
						return Html::a('Edit Berkas',['lihat-berkas', 'id'=>$model->Kd_Musrenbang_Kelurahan],['class'=>'btn btn-warning btn-sm']);
					else
						return Html::a('Edit Berkas',['lihat-berkas', 'id'=>$model->Kd_Musrenbang_Kelurahan],['class'=>'btn btn-warning btn-sm', 'disabled' => 'disabled']);
					
				},
				
				],
			
			
			],
        ],
    ]); ?>
</div>
