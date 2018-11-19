<?php  

use yii\helpers\Html;
use yii\grid\GridView;
     
?>

<?=
	GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			[
				'header' => 'Asal Usulan',
				'format' => 'html',
				'value' => function ($model) {
					if (isset($model->lingkungan->Nm_Lingkungan) AND isset($model->kelurahan->Nm_Kel)) {
						return '<strong>'.$model->lingkungan->Nm_Lingkungan.", Kel.".$model->kelurahan->Nm_Kel.", Kec.".$model->kecamatan->Nm_Kec.'</strong>';
					}
					else if (!isset($model->lingkungan->Nm_Lingkungan) AND isset($model->kelurahan->Nm_Kel)) {
						return '<strong>'."Kel.".$model->kelurahan->Nm_Kel.", Kec.".$model->kecamatan->Nm_Kec.'</strong>';
					}
					else if (!isset($model->lingkungan->Nm_Lingkungan) AND !isset($model->kelurahan->Nm_Kel)) {
						return '<strong>'."Kec.".$val->kecamatan->Nm_Kec.'</strong>';
					}
    			},
			],
			[
				'format' => 'html',
				'header' => 'Detail Lokasi',
				'value' => function ($model) {
					if (!isset($model->Detail_Lokasi) OR $model->Detail_Lokasi == '' OR empty($model->Detail_Lokasi)) {
						return '-';
					}
					else {
						if ($model->Latitute == NULL OR !isset($model->Latitute) OR empty($model->Latitute) OR $model->Latitute == '') 
						{
                            return $model->Detail_Lokasi.'';
                       	}
                       	else {
                       		return '<p>'.$model->Detail_Lokasi.'</p>'
                       			.'<a href="https://www.google.com/maps/@'.$model->Latitute.','.$model->Longitude.',17z" target="_blank"><span class="label label-info"><i class="fa fa-map-marker"></i>Peta Lokasi</span></a>';
                       	}
					}
    			},
			],
			[
				'header' => 'Usulan',
				'format' => 'html',
				'value' => function ($model) {
        			return '<span class="label label-success">Usulan</span>'.'<br/>'.$model->Jenis_Usulan
        					.'<br/>'.'<br/>'
        					.'<span class="label label-danger">Permasalahan</span>'.'<br/>'.$model->Nm_Permasalahan;
    			},
			],
			[
				'header' => 'Jumlah/Vol',
				'value' => function ($model) {
        			return $model->Jumlah.' '.$model->satuan->Uraian;
    			},	
			],
			'taForumLingkungan.taUsulanLingkunganMedia.Kd_Media',
		]
    ])
?>