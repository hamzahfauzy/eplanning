<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\components\Helper;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->registerJsFile(
    '@web/js/musrenbang.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Usulan Forum Perangkat Daerah';
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
                  'action' => ['ta-musrenbang/cetak-usulan-forum'], 
                  'options' => ['target' => '_blank']
      ]) ?>
      <div class="form-group">
          <div class="col-sm-2">
              <br>
              <?= Html::submitButton('&nbsp;Cetak&nbsp;', ['id' => 'cari-submit', 'class' => 'btn btn-primary']); ?>
          </div>
      </div>
      <?php \yii\bootstrap\ActiveForm::end() ?>
  </div>
            </div>
            <div class="box-body">
                <table class="table table-hover table-bordered">
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
							
                         /*   [
                                'attribute'=>'Status_Prioritas',
                                'filter'=>[""=>"Semua", "1"=>"Prioritas", 0=>"Cadangan" ],
                                'value' => function ($model) {
                                    if($model->Status_Prioritas)
                                        return 'Prioritas';   
                                    else
                                        return 'Cadangan';   
                                } 
                            ],*/
							 [
                                'attribute'=>'Status_Penerimaan_Kota',
                                'filter'=>[""=>"Semua", "1"=>"Masuk Renja", "0"=>"Belum Masuk"],
                                'value' => function ($model) {
                                    if($model->Status_Penerimaan_Kota)
                                        return 'Masuk Renja';   
                                    else
                                        return 'Belum Masuk';   
                                }
                            ],
							[
                                 'attribute' => 'Kd_Sub',
                                 'value' => 'refSubUnit.Nm_Sub_Unit',
								 //'filter' => $data_skpd,
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
                                'template' => Helper::filterActionColumn('{view}{update}{delete}')
                            ],
                        ],
                        ]); 
                    ?>
                
                </table>
            </div>
        </div>
               
    </div>
</div>
<script type="text/javascript">

    $("#btn_lihat_dokumen").click(function(){
      var alamat = $(this).data('url');
      //alert(alamat);
      $('#lihatDokumen').modal('show')
            .find('#isi_modal_dokumen')
            .html("Loading...");

      $.post('index.php?r=ta-musrenbang/dokumen-kecamatan', function(data){
          //alert(data);
      $('#lihatDokumen')
            .find('#isi_modal_dokumen')
            .html(data);
      })
    });

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
<?php
Modal::begin([
    'header' => '<h4>Lihat File</h4>',
    "size"=>"modal-default",
    'footer' => Html::button('Tutup',['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]),
    "id"=>"lihatFileModal",
]);
echo "<div id='isi_modal'></div>";
Modal::end();
?>

<?php
Modal::begin([
    'header' => '<h4>Dokumen</h4>',
    "size"=>"modal-lg",
    'footer' => Html::button('Tutup',['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]),
    "id"=>"lihatDokumen",
]);
echo "<div id='isi_modal_dokumen'></div>";
Modal::end();
?>