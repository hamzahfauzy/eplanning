<?php


use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\RefProgram;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefKegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

 // $idLevel=Yii::$app->user->identity->id_level;
$user = Yii::$app->levelcomponent->getUnit();

 // $ref=new Referensi;

  $cookies = Yii::$app->request->cookies;
 if(!empty($cookies['skpd'])){
    $meIdUrusan=$cookies['urusan']->value;
    $meIdBidang=$cookies['bidang']->value;
    // $meIdSkpd=$cookies['skpd']->value;
    // $meIdSub=$cookies['subUnit']->value;
    }else{
    $meIdUrusan=$user->Kd_Urusan;
    $meIdBidang=$user->Kd_Bidang;
    $meIdUnit=$user->Kd_Unit;
    $meIdSub=$user->Kd_Sub_Unit;
	// $meIdSkpd=Yii::$app->user->identity->id_skpd;
	// $meIdUrusan=Yii::$app->user->identity->id_urusan;
	// $meIdBidang=Yii::$app->user->identity->id_bidang;
    // $meIdSub=Yii::$app->user->identity->id_subunit;
}

// $meDataUrusan=$ref->getUrusanOne($meIdUrusan);
// $meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
// $meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

// $meDataSub=null;
// if($meIdSub!=0){
//     $meDataSub=$ref->getSubUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub);
// }

// $singkron=$ref->getSingkronisasiProgram($meIdUrusan,$meIdBidang,$KdProg);

$this->title = 'Usulan Kegiatan';
$this->params['breadcrumbs'][] = ['label' => 'Program Usulan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="ta-belanja-index">
    <div class="box box-success">
        <div class="box-body">
            <table id="" class="table table-bordered table-hover">
            <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= Yii::$app->session->getFlash('error') ?>
            </div>
            <?php endif; ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <table class="table table-striped rkaTable">
        <tbody>
           <tr>
                <td class="col-md-2">Urusan</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >

                   <?php
                    foreach ($modelUnit as $data) : ?>                     
                    <?php echo $data->Kd_Urusan; ?> 
                </td>
                <td>
                    <?php echo $data->urusan->Nm_Urusan; ?>
                </td>
                   
                    <?php endforeach; ?>

                </td>
                <td>
                    
                </td>
            </tr>
             <tr>
                <td class="col-md-2">Bidang</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                   <?php
                    foreach ($modelUnit as $data) : ?>                     
                    <?php echo $data->Kd_Urusan.".".$data->Kd_Bidang; ?> 
                </td>
                <td>
                    <?php echo $data->kdBidang->Nm_Bidang; ?>
                </td>
                   
                    <?php endforeach; ?>
                </td>
                <td>
                    
                </td>
            </tr>

            <tr>
                <td class="col-md-2">Unit</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                   <?php
                    foreach ($modelUnit as $data) : ?>                     
                    <?php echo $data->Kd_Urusan.".".$data->Kd_Bidang.".".$data->Kd_Unit; ?> 
                </td>
                <td>
                    <?php echo $data->kdUrusan->Nm_Unit; ?>
                </td>
                   
                    <?php endforeach; ?>
                </td>
                <td>
                    
                </td>
            </tr>

             <tr>
                <td class="col-md-2">Sub Unit</td>
                <td class="col-md-0 padding-edge">:</td>
                <td>
                   <?php foreach ($modelUnit as $data) : ?> 
                    
                    <?php echo $data->Kd_Urusan.".".$data->Kd_Bidang.".".$data->Kd_Unit.".".$data->Kd_Sub; ?> 
                    </td>
                    <td>
                   <?php echo $data->namaSub->Nm_Sub_Unit; ?>
                    </td>
                   
                    <?php endforeach; ?>
                </td>
                <td>
                   
                </td>
            </tr>

            <tr>
                <td class="col-md-2">Program</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >   
                   <?= $meIdUrusan.".".$meIdBidang.".".$meIdUnit.".".$meIdSub.".".$KdProg; ?>
                   
                </td>
                    
                <td>
                    <?= $ketProgram ?>
                </td>
                <td>
                </td>
            </tr>
                
            <!-- Sinkornasi Program -- >
            <tr>
                    <td class="col-md-2">Prioritas Nasional</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-md-2">Nawacita</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-md-2">Urusan Pembangunan</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-md-2">Misi Pembangunan</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
        </tbody>
    </table>
<!-- <?php
//if(Yii::$app->levelcomponent->isRoles('Operator_Skpd')){
?> -->
    <p>
        <?= Html::a('Tambah Usulan Kegiatan',['tambahkeg','id'=>$KdProg ], ['class' => 'btn btn-success'])  ?>
    </p>
<!-- <?php
//}
?> -->

<?php
if(Yii::$app->levelcomponent->isRoles('Operator_Skpd')){
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.'
            ],
            [
                'attribute' =>'Ket_Kegiatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Cari Nama Kegiatan'
                ],
                'format' => 'raw',
                'value' => function($model){
                    // $ref=new Referensi;
                    return Html::a($model->Kd_Keg.":".$model->Ket_Kegiatan, ['ta-belanja/listbelanja','Kd_Prog'=>$model->Kd_Prog, 'Kd_Keg'=>$model->Kd_Keg ], ['class' => 'btn btn-success  tunder']);
                }
            ],
            // [
            //     'attribute' =>'Keterangan',
            //     'format' => 'raw',
            //     'options' => ['class'=>'col-md-4'],
            //     'value' => function($model){
            //         $ref=new Referensi;
            //         $cookies = Yii::$app->request->cookies;
            //         if(!empty($cookies['skpd'])){
            //             $meIdSkpd=$cookies['skpd']->value;
            //         }else{
            //             $meIdSkpd=Yii::$app->user->identity->id_skpd;
            //         }
            //         return $ref->getKeteranganUraian($model->Kd_Urusan,$model->Kd_Bidang,$meIdSkpd,$model->Kd_Prog,$model->Kd_Keg);
            //     }
            // ]
        ],
    ]); ?>
<?php
}else{
?>
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.'
            ],
            [
                'attribute' =>'Usulan Kegiatan',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Cari Nama Kegiatan'
                ],
                'format' => 'raw',
                'value' => function($model){
                    $ref=new Referensi;
                    return Html::a($model->Kd_Keg.":".$model->Ket_Kegiatan, ['ta-belanja/listbelanja','id'=>$model->Kd_Prog, 'idkeg'=>$model->Kd_Keg ], ['class' => 'btn btn-success  tunder']);
                }
            ],
            // [
            //     'attribute' =>'Keterangan',
            //     'format' => 'raw',
            //     'options' => ['class'=>'col-md-4'],
            //     'value' => function($model){
            //         $ref=new Referensi;
            //         $cookies = Yii::$app->request->cookies;
            //         if(!empty($cookies['skpd'])){
            //             $meIdSkpd=$cookies['skpd']->value;
            //         }else{
            //             $meIdSkpd=Yii::$app->user->identity->id_skpd;
            //         }
            //         return $ref->getKeteranganUraian($model->Kd_Urusan,$model->Kd_Bidang,$meIdSkpd,$model->Kd_Prog,$model->Kd_Keg);
            //     }
            // ],
            [
                'attribute' =>'Uraian Kegiatan',
                'format' => 'raw',
                'options' => ['class'=>'col-md-1 inCenter'],
                'value' => function($model){
                    $ref=new Referensi;
                    if($ref->getCountUrusan($model->Kd_Prog,$model->Kd_Keg)){
                        return Html::a('<i class="glyphicon glyphicon-ok" style="font-size:12px;"></i>', ['ta-kegiatan/uraian','kdprog'=>$model->Kd_Prog, 'kdkeg'=>$model->Kd_Keg], ['class' => 'btn btn-primary iconB']);
                    }else{
                        return "-";
                    }
                }
            ],
            [
                'attribute' =>'Indikator Kegiatan',
                'format' => 'raw',
                'options' => ['class'=>'col-md-1 inCenter'],
                'value' => function($model){
                    $ref=new Referensi;
                    $total=$ref->getCountIndikator($model->Kd_Prog,$model->Kd_Keg);
                    if($total>=3){
                        return Html::a('<i class="glyphicon glyphicon-ok" style="font-size:12px;"></i>', ['ta-indikator/indikator','kdprog'=>$model->Kd_Prog, 'kdkeg'=>$model->Kd_Keg], ['class' => 'btn btn-primary iconB']);
                    }else{
                        return "-";
                    }

                }
            ],
            [
                'attribute' =>'Pagu Anggaran',
                'format' => 'raw',
                'value' => function($model){
                    $ref=new Referensi;
                    $unit=Yii::$app->user->identity->id_skpd;
                    $sub = Yii::$app->user->identity->id_subunit;
                    return "<div class='text-right'>".$ref->getPaguKegiatan(
                        $model->Kd_Urusan,
                        $model->Kd_Bidang,
                        $unit,
                        $sub,
                        $model->Kd_Prog,
                        $model->Kd_Keg
                    )."</div>";
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update}{delete}',
                'options' => ['class'=>'col-md-1'],
                'buttons'=>[
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash" style="margin-left: 10px;"></span>',
                            ['delete','tahun'=>date('Y'), 'Kd_Prog'=>$model->Kd_Prog, 'Kd_Keg'=>$model->Kd_Keg ],
                            [ 'title' => Yii::t('app', 'Hapus'),
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ]
                            ]
                        );
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil" style="margin-left: 10px;"></span>',
                            ['update','tahun'=>date('Y'), 'Kd_Prog'=>$model->Kd_Prog, 'Kd_Keg'=>$model->Kd_Keg ],
                            [ 'title' => Yii::t('app', 'Ubah'),
                                'data' => [
                                    'method' => 'post',
                                ]
                            ]
                        );
                    }
                ],
            ],
        ],
    ]); ?>

    <?php
}
?>      
            </table>
        </div>
    </div>        
</div>
