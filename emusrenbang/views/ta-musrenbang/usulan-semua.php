<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\components\Helper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->title = 'Usulan Kecamatan';
$this->params['breadcrumbs'][] = ['label' => 'Ta Musrenbangs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="ta-musrenbang-view col-md-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">
                    <?= $this->title; ?>
                </h3>
                <div class="control-wrap">
                    <?php $form = \yii\bootstrap\ActiveForm::begin([
                                          'id' => 'search-usulan',
                                'action' => ['ta-musrenbang/cetak-usulan-kecamatan'], 
                                'options' => ['target' => '_blank']
                    ]) ?>
                    <div class="form-group">
                        <div class="col-sm-2">
                            <br>
                            <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary btn-lg']); ?>
                        </div>
                    </div>
                    <?php \yii\bootstrap\ActiveForm::end() ?>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table">
                      <?= 
                          GridView::widget([
                          'dataProvider' => $dataProvider,
                          'filterModel' => $searchModel,
                          'columns' => [
                              ['class' => 'yii\grid\SerialColumn'],

                              [
                                'attribute' => 'Kd_Kec',
                                'value' => 'kecamatan.Nm_Kec',
                                'filter'=> $data_kecamatan,
                              ],
                              [
                                'attribute' => 'Kd_Kel',
                                'value' => 'kelurahan.Nm_Kel',
                                'filter'=> $data_kelurahan,
                              ],
                              [
                                'attribute' => 'Kd_Lingkungan',
                                'value' => 'lingkungan.Nm_Lingkungan',
                                'filter'=> $data_lingkungan,
                                'contentOptions'=>['style'=>'width: 200px;']
                              ],
                              [
                                'attribute' => 'Kd_Pem',
                                'value' => 'bidangPembangunan.Bidang_Pembangunan',
                                'filter'=> $data_bidpem,
                              ],
                              [
                                'attribute' => 'Kd_Prioritas_Pembangunan_Daerah',
                                'value' => 'rpjmdx.Nm_Prioritas_Pembangunan_Kota',
                                'filter'=> $data_rpjmd,
                              ],
                              'Nm_Permasalahan:ntext',
                              'Jenis_Usulan:ntext',
                              'Detail_Lokasi:ntext',
							  'Jumlah',
                            [
                                'label' => 'Satuan',
                                'value' => 'satuan.Uraian',
                            ],
							[
							'label' => 'Pagu (Rp.)',
                                'value' => 'Harga_Total',
                                'format' => ['decimal', 2],
                                'contentOptions' => ['class' => 'text-right'],
							],
                              'Skor',
							  
                              [
                                  'attribute'=>'Status_Prioritas',
                                  'filter'=>[""=>"Semua", "1"=>"Prioritas", '0'=>"Cadangan"],
                                  'value' => function ($model) {
                                      if($model->Status_Prioritas)
                                          return 'Prioritas';   
                                      else
                                          return 'Cadangan';   
                                  }
                              ],
							  
							   [
                                'header' => 'Dokumen',
                                'format' => 'raw',
                                'value' => function ($model) {
                                      if (isset($model->taMusrenbangKelurahan->Kd_Ta_Musrenbang_Kelurahan)) {
                                    
                                        $tombols ='';

                                        $foto = $model->taMusrenbangKelurahan->getTaUsulanKelurahanMedia()->all();
                                        foreach ($foto as $value) {
							
                                            $Jenis_Media = $value->kdMedia->Jenis_Media;
											$Nm_Media = $value->kdMedia->Nm_Media;
				
											$url="http://eplanning.asahankab.go.id/eperencanaan/eperencanaan/web/data/".$Nm_Media;
									$tombols.= '<button class="btn btn-danger" data-toggle="modal" data-target="#myModal" value="'.$url.'" onclick="tambah_semangat(this.value)">'.$Jenis_Media.'</button>';
                                        }

                                        return $tombols;
                                    }
                                    
                                },  
                            ],
                              [
                                  'class' => 'yii\grid\ActionColumn',
                                  'template' => Helper::filterActionColumn('{view}')
                              ],
                          ],
                          ]); 
                      ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function tambah_semangat(xKol){
		var alamat = xKol;
		var sumber = ""+alamat;
		$("#img").attr("src", sumber);
	}
</script>
	
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <?php $form = ActiveForm::begin() ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             
                    </div>
                    <div class="modal-body" > 
				
						
						<img src="" id="img" alt="" class="img-responsive">
						
                    </div>
                    <div class="modal-footer">

                    </div>
                    <?php ActiveForm::end(); ?>
        </div> 
    </div>
</div> 