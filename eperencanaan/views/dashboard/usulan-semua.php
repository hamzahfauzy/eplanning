<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use common\models\RefKelurahan;
use common\models\RefLingkungan;
use common\models\RefKecamatan;
use common\models\RefJalan;

$this->registerJsFile(
    '@web/js/musrenbang/lihat_usulan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJsFile(
    '@web/js/dashboard.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);
include"header.php";
?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
                                <h3>Informasi Usulan Semua</h3>
                            </div>
                            <div class="widget-tabbed margin-top-30">
                                <ul class="nav nav-tabs">
									<li class="active"><a href="#diterima">Diterima</a></li>
									<li><a href="#ditolak">Ditolak</a></li>
								  </ul>                        
								<div class="tab-content">
									<div class="tab-pane fade in active" id="diterima">
										<div class="col-md-12">
											<div class="row table-responsive">
												<?=
													GridView::widget([
														'dataProvider' => $dataProviderTerima,
														'filterModel' => $searchModelTerima,
														'columns' => [
															['class' => 'yii\grid\SerialColumn'],
															[
																'attribute' => 'Kd_Kec',
																'value' => 'kecamatan.Nm_Kec',
																'filter' => Html::activeDropDownList($searchModelTerima, 'Kd_Kec', 
																	$data_kec,
																	[
																		'class' => 'form-control',
																		'prompt' => 'Pilih Kecamatan' 
																	]
																),
															],
															[
																'attribute' => 'Kd_Urut_Kel',
																'value' => 'kelurahan.Nm_Kel',
																'filter' => 
																		ArrayHelper::map(RefKelurahan::find()
																		->where(['Kd_Prov' => 12])
																		->andwhere(['Kd_Kab' => 9])
																		->andwhere(['Kd_Kec' => $searchModelTerima->Kd_Kec])
																		->orderBy(['Nm_Kel' => SORT_ASC])
																		->all(), 
																		'Kd_Urut', 
																		'Nm_Kel'
																),
															],
															[
																'attribute' => 'Kd_Lingkungan',
																'value' => 'lingkungan.Nm_Lingkungan',
																'filter' => 
																		ArrayHelper::map(RefLingkungan::find()
																		->where(['Kd_Prov' => 12])
																		->andwhere(['Kd_Kab' => 9])
																		->andwhere(['Kd_Kec' => $searchModelTerima->Kd_Kec])
																		->andwhere(['Kd_Urut_Kel' => $searchModelTerima->Kd_Urut_Kel])
																		->orderBy(['Nm_Lingkungan' => SORT_ASC])
																		->all(), 
																		'Kd_Lingkungan', 
																		'Nm_Lingkungan'
																),
															],
															[
																'attribute' => 'Kd_Jalan',
																'value' => 'kdJalan.Nm_Jalan',
																'filter' => \kartik\select2\Select2::widget([
																	'model' => $searchModelTerima,
																	'attribute' => 'Kd_Jalan',
																	'data' => $ref_jalan
																]),
															],
															// [
															//     'attribute' => 'Kd_Jalan',
															//     'label' => 'Jalan',
															//     'value' => 'kdJalan.Nm_Jalan',
															//     'filter' => 
															//             ArrayHelper::map(RefJalan::find()
															//             ->where(['Kd_Prov' => 12])
															//             ->andwhere(['Kd_Kab' => 71])
															//             ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
															//             ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Urut_Kel])
															//             ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Lingkungan])
															//             ->all(), 
															//             'Kd_Jalan', 
															//             'Nm_Jalan'
															//     ),
															// ],
															[
																'label' => 'Detail Lokasi',
																'attribute' => 'Detail_Lokasi',
																'format' => 'raw',
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
																'attribute' => 'Nm_Permasalahan',
																'label' => 'Permasalahan',
															],
															[
																'attribute' => 'Jenis_Usulan',
																'label' => 'Usulan',
															],                                            [
																'header' => 'Jumlah/Vol',
																'value' => function ($model) {
																	return $model->Jumlah.' '.$model->satuan->Uraian;
																},  
															],
															[
																'header' => 'Dokumen',
																'format' => 'raw',
																'value' => function ($model) {
																	
																	// $jlh_foto = $model->taForumLingkungan->getTaUsulanLingkunganMedia()->count();
																	// return $jlh_foto;
																	if (isset($model->taForumLingkungan->Kd_Ta_Forum_Lingkungan)) {
																		
																		$tombols ='';

																		$foto = $model->taForumLingkungan->getTaUsulanLingkunganMedia()->all();
																		foreach ($foto as $value) {

																			$Jenis_Media = $value->kdMedia->Jenis_Media;
																			$Nm_Media = $value->kdMedia->Nm_Media;

																			$url = "index.php?r=dashboard/lihat-file&nama_file=".$Nm_Media;

																			$tombols .= '<button type="button" class="btn btn-primary btn-xs lihat_file" data-url="'.$url.'">'.$Jenis_Media.'</button>';
																		}

																		return $tombols;
																	}
																	else {
																		return '-';
																	}
																	
																},  
															],
															[
																'header' => 'Asal Usulan',
																'format' => 'raw',
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
														]
													]);
												?>
											</div>
										</div>
									</div>

									<div  class="tab-pane fade" id="ditolak">                                               
										<div class="table-responsive">
											<?=
												GridView::widget([
													'dataProvider' => $dataProviderTolak,
													//'filterModel' => $searchModelTolak,
													'columns' => [
														['class' => 'yii\grid\SerialColumn'],
														[
															'attribute' => 'Kd_Kec',
															'value' => 'kdKec.Nm_Kec',
															'filter' => Html::activeDropDownList($searchModelTolak, 'Kd_Kec', 
																$data_kec,
																[
																	'class' => 'form-control',
																	'prompt' => 'Pilih Kecamatan' 
																]
															),
														],
														[
															'attribute' => 'Kd_Urut_Kel',
															'value' => 'kdKel.Nm_Kel',
															'filter' => 
																	ArrayHelper::map(RefKelurahan::find()
																	->where(['Kd_Prov' => 12])
																	->andwhere(['Kd_Kab' => 9])
																	->andwhere(['Kd_Kec' => $searchModelTolak->Kd_Kec])
																	->orderBy(['Nm_Kel' => SORT_ASC])
																	->all(), 
																	'Kd_Urut', 
																	'Nm_Kel'
															),
														],
														[
															'attribute' => 'Kd_Lingkungan',
															'value' => 'kdLink.Nm_Lingkungan',
															'filter' => 
																	ArrayHelper::map(RefLingkungan::find()
																	->where(['Kd_Prov' => 12])
																	->andwhere(['Kd_Kab' => 9])
																	->andwhere(['Kd_Kec' => $searchModelTolak->Kd_Kec])
																	->andwhere(['Kd_Urut_Kel' => $searchModelTolak->Kd_Urut_Kel])
																	->orderBy(['Nm_Lingkungan' => SORT_ASC])
																	->all(), 
																	'Kd_Lingkungan', 
																	'Nm_Lingkungan'
															),
														],
														[
															'attribute' => 'Kd_Jalan',
															'value' => 'kdJalan.Nm_Jalan',
															'filter' => \kartik\select2\Select2::widget([
																'model' => $searchModelTolak,
																'attribute' => 'Kd_Jalan',
																'data' => $ref_jalan
															]),
														],
														// [
														//     'attribute' => 'Kd_Jalan',
														//     'label' => 'Jalan',
														//     'value' => 'kdJalan.Nm_Jalan',
														//     'filter' => 
														//             ArrayHelper::map(RefJalan::find()
														//             ->where(['Kd_Prov' => 12])
														//             ->andwhere(['Kd_Kab' => 9])
														//             ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
														//             ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Urut_Kel])
														//             ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Lingkungan])
														//             ->all(), 
														//             'Kd_Jalan', 
														//             'Nm_Jalan'
														//     ),
														// ],
														[
															'label' => 'Detail Lokasi',
															'attribute' => 'Detail_Lokasi',
															'format' => 'raw',
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
															'attribute' => 'Nm_Permasalahan',
															'label' => 'Permasalahan',
														],
														[
															'attribute' => 'Jenis_Usulan',
															'label' => 'Usulan',
														],                                            [
															'header' => 'Jumlah/Vol',
															'value' => function ($model) {
																return $model->Jumlah.' '.$model->kdSatuan->Uraian;
															},  
														],
														[
															'header' => 'Dokumen',
															'format' => 'raw',
															'value' => function ($model) {
																
																// $jlh_foto = $model->taForumLingkungan->getTaUsulanLingkunganMedia()->count();
																// return $jlh_foto;
																if (isset($model->Kd_Ta_Forum_Lingkungan)) {
																	
																	$tombols ='';

																	$foto = $model->getTaUsulanLingkunganMedia()->all();
																	foreach ($foto as $value) {

																		$Jenis_Media = $value->kdMedia->Jenis_Media;
																		$Nm_Media = $value->kdMedia->Nm_Media;

																		$url = "index.php?r=dashboard/lihat-file&nama_file=".$Nm_Media;

																		$tombols .= '<button type="button" class="btn btn-primary btn-xs lihat_file" data-url="'.$url.'">'.$Jenis_Media.'</button>';
																	}

																	return $tombols;
																}
																else {
																	return '-';
																}
																
															},  
														],
														[
															'header' => 'Asal Usulan',
															'format' => 'raw',
															'value' => function ($model) {
																if (isset($model->kdLink->Nm_Lingkungan) AND isset($model->kdKel->Nm_Kel)) {
																	return '<strong>'.$model->kdLink->Nm_Lingkungan.", Kel.".$model->kdKel->Nm_Kel.", Kec.".$model->kdKec->Nm_Kec.'</strong>';
																}
																else if (!isset($model->kdLink->Nm_Lingkungan) AND isset($model->kdKel->Nm_Kel)) {
																	return '<strong>'."Kel.".$model->kdKel->Nm_Kel.", Kec.".$model->kdKec->Nm_Kec.'</strong>';
																}
																else if (!isset($model->kdLink->Nm_Lingkungan) AND !isset($model->kdKel->Nm_Kel)) {
																	return '<strong>'."Kec.".$val->kdKec->Nm_Kec.'</strong>';
																}
															},
														],
													]
												]);
											?>
										</div>
									</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
<?php include"footer.php"; ?>
<?php
Modal::begin([
    'header' => '<h4>Lihat File</h4>',
    "size"=>"modal-default",
    'footer' => Html::button('Tutup',['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]),
    "id"=>"lihatFileModal",
]);
echo "<div id='lihatFileContent' class='isi-modal'></div>";
Modal::end();
?>