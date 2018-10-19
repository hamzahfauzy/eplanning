<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\widgets\Select2;
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
                                <h3>Informasi Usulan Musrenbang Kecamatan</h3>
                            </div>

                            <?php echo $this->render('_search-kecamatan', ['model' => $searchModel]); ?>

                            <div class="row table-responsive">
                                <?=
                                    GridView::widget([
                                        'dataProvider' => $dataProvider,
                                        // 'filterModel' => $searchModel,
                                        'columns' => [
                                            ['class' => 'yii\grid\SerialColumn'],
                                            [
                                                'attribute' => 'Kd_Kec',
                                                'value' => 'kecamatan.Nm_Kec',
                                                'filter' => Html::activeDropDownList($searchModel, 'Kd_Kec', 
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
                                                'filter' => ArrayHelper::map(RefKelurahan::find()
                                                            ->where(['Kd_Prov' => 12])
                                                            ->andwhere(['Kd_Kab' => 9])
                                                            ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
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
                                                        ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
                                                        ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Urut_Kel])
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
                                                    'model' => $searchModel,
                                                    'attribute' => 'Kd_Jalan',
                                                    'data' => $ref_jalan
                                                ]),
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
                                            [
                                                'attribute' => 'Nm_Permasalahan',
                                                'label' => 'Permasalahan',
                                            ],
                                            [
                                                'attribute' => 'Jenis_Usulan',
                                                'label' => 'Usulan',
                                            ],                                            
                                            [
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