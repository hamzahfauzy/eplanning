<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\components\Helper;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use common\models\RefKelurahan;
use common\models\RefLingkungan;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->registerJsFile(
    '@web/js/musrenbang.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->title = 'Usulan Lingkungan';
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
                <div class="table-responsive">
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
                                'attribute' => 'Kd_Urut_Kel',
                                'value' => 'kelurahan.Nm_Kel',
                                'filter' => 
                                        ArrayHelper::map(RefKelurahan::find()
                                        ->where(['Kd_Prov' => 13])
                                        ->andwhere(['Kd_Kab' => 75])
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
                                        ->where(['Kd_Prov' => 13])
                                        ->andwhere(['Kd_Kab' => 75])
                                        ->andwhere(['Kd_Kec' => $searchModel->Kd_Kec])
                                        ->andwhere(['Kd_Urut_Kel' => $searchModel->Kd_Urut_Kel])
                                        ->orderBy(['Nm_Lingkungan' => SORT_ASC])
                                        ->all(), 
                                        'Kd_Lingkungan', 
                                        'Nm_Lingkungan'
                                ),
                            ],
                            [
                              'attribute' => 'Kd_Pem',
                              'value' => 'bidangPembangunan.Bidang_Pembangunan',
                              'filter'=> $data_bidpem,
                            ],
                            [
                              'attribute' => 'Kd_Prioritas_Pembangunan_Daerah',
                              'value' => 'rpjmd.Nm_Prioritas_Pembangunan_Kota',
                              'filter'=> $data_rpjmd,
                            ],
                            'Nm_Permasalahan:ntext',
                            'Jenis_Usulan:ntext',
                            'Detail_Lokasi:ntext',
                            'Skor',
                            [
                                'attribute'=>'Status_Prioritas',
                                'filter'=>[""=>"Semua", "1"=>"Prioritas", 0=>"Cadangan" ],
                                'value' => function ($model) {
                                    if($model->Status_Prioritas)
                                        return 'Prioritas';   
                                    else
                                        return 'Cadangan';   
                                }
                            ],
                            [
                              'label' => 'Verifikasi',
                              'format' => 'raw',
                              'value' => function($model) {

                                $btn ="
                                  <select data-id='".$model->id."' class=''>
                                    <option>-Pilih-</option>
                                  <option value='1'>Terima</option>
                                  <option value='3'>Tolak</option>
                                </select>
                              ";
                              return $btn;
                            }
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
					
                                            $url = "index.php?r=ta-musrenbang/lihat-file&nama_file=".$Nm_Media;

                                            $tombols .= '<button type="button" class="btn btn-primary btn-xs lihat_file" data-url="'.$url.'">'.$Jenis_Media.'</button>';
                                        }

                                        return $tombols;
                                    }
                                    
                                },  
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => Helper::filterActionColumn('{view}{delete}')
                            ],
                        ],
                        ]); 
                    ?>
                
                </div>
            </div>
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