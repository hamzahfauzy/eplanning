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

$this->title = 'Usulan Pokir';
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
            </div>
            <div class="box-body">
                <table class="table table-hover table-bordered">
                <!-- <table class="table table-hover table-bordered"> -->
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
                            'Nm_Permasalahan:ntext',
                            'Jenis_Usulan:ntext',
                            [
                                'attribute' => 'Kd_Pem',
                                'value' => 'bidangPembangunan.Bidang_Pembangunan',
                                'filter' => $data_bidpem,
                            ],
                            [
                                'attribute' => 'Kd_Prioritas_Pembangunan_Daerah',
                                'value' => 'rpjmdx.Nm_Prioritas_Pembangunan_Kota',
                                'filter' => $data_rpjmd,
                            ],
                             [
                                 'attribute' => 'Kd_Sub',
                                 'value' => 'refSubUnit.Nm_Sub_Unit',
                             ],
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
							//'Skor',
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
                          /*  [ 
                                'attribute' => 'Kd_Dapil',
                                'value' => 'dapil.Nm_Dapil',
                                'filter' => $data_dapil,
                            ],*/
                            //'Harga_Satuan',
                            //'Harga_Total:ntext',
                            [
                                'header' => 'Dokumen',
                                'format' => 'raw', 
                                'value' => function ($model) {
                                    
                                    // $jlh_foto = $model->taForumLingkungan->getTaUsulanLingkunganMedia()->count();
                                    // return $jlh_foto;
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
                
                <!-- </table> -->
                </table>
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