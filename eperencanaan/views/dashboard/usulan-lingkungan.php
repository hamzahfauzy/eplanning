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

include"header.php"; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
                                <h3>Informasi Usulan Rembuk Warga</h3>
                            </div>
                            
                            <?php echo $this->render('_search-lingkungan', ['model' => $searchModel]); ?>

                            <div class="row table-responsive">
                                <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                                'attribute' => 'Kd_Kec',
                                                'value' => 'kdKec.Nm_Kec',
                                            ],
                                            [
                                                'attribute' => 'Kd_Kel',
                                                'value' => 'kdKel.Nm_Kel'
                                            ],
                                            [
                                                'attribute' => 'Kd_Lingkungan',
                                                'value' => 'kdLink.Nm_Lingkungan'
                                            ],
                                            [
                                                'attribute' => 'Kd_Jalan',
                                                'value' => 'kdJalan.Nm_Jalan'
                                            ],
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
                                            'Nm_Permasalahan',
                                            'Jenis_Usulan',
                                            [
                                                'header' => 'Jumlah/Vol',
                                                'value' => function ($model) {
                                                    return $model->Jumlah.' '.$model->kdSatuan->Uraian;
                                                },  
                                            ],
                                            [
                                                'header' => 'Dokumen',
                                                'format' => 'raw',
                                                'value' => function ($model) {
                                                    
                                                    if (isset($model->Kd_Ta_Forum_Lingkungan))
                                                    {
                                                        
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
                                        ]
                                    ]);
                                ?>    
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
echo "<div id='isi_modal'></div>";
Modal::end();
?>