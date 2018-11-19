<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $searchModel app\models\RefKegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $ref=new Referensi;
$idLevel=Yii::$app->user->identity->id_level;


if($idLevel!=8){
$meIdUrusan=Yii::$app->user->identity->id_urusan;
$meIdBidang=Yii::$app->user->identity->id_bidang;
$meIdSkpd=Yii::$app->user->identity->id_skpd;
$meIdSub=Yii::$app->user->identity->id_subunit;

$meDataUrusan=$ref->getUrusanOne($meIdUrusan);

$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$meDataSub=null;
if($meIdSub!=0){
    $meDataSub=$ref->getSubUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub);
}

$this->title = 'Program Usulan';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ref-kegiatan-index">
    <table class="table table-striped rkaTable">
        <tbody>
            <tr>
                <td class="col-md-2">Urusan Pemerintahan</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?= $meIdUrusan.".".$meIdBidang ?>
                </td>
                <td>
                    <?php echo $meDataUrusan->Nm_Urusan." ".$meDataBidang->Nm_Bidang ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Organisasi</td>
                <td class="col-md-0 padding-edge">:</td>
                <td>
                    <?php if($meDataSub){ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$meIdSub ?>
                    <?php }else{ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd ?>
                    <?php } ?>
                </td>
                <td>
                    <?php if($meDataSub){ ?>
                        <?= $meDataSub->Nm_Sub_Unit ?>
                    <?php }else{ ?>
                        <?= $meDataUnit->Nm_Unit ?>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.'
            ],

            [
                'attribute' =>'Ket_Program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Cari Nama Program'
                ],
                'format' => 'raw',
                'value' => function($model){
                    $ref=new Referensi;
                    $meIdSkpd=Yii::$app->user->identity->id_skpd;
                    return Html::a($model->Kd_Prog.":".$model->Ket_Program, ['kegiatan', 'id'=>$model->Kd_Prog], ['class' => 'btn btn-success  tunder']).
                    Html::a($ref->getKegiatanByCount($model->Kd_Urusan,$model->Kd_Bidang,$meIdSkpd,$model->Kd_Prog).' Kegiatan', ['kegiatan', 'id'=>$model->Kd_Prog], ['class' => 'btn btn-warning']);
                }
            ]
        ],
    ]); ?>
</div>
<?php
}else{


$this->title = 'Program';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = $this->title;

	$unit=array();
	foreach($modelLevel as $d){
        if($d['Kd_Sub']==0){
            $nama=$d['Nm_Unit'];
        }else{
            $nama=$d['Nm_Sub_Unit'];
        }
        $unit[$d['Kd_Urusan'].'-'.$d['Kd_Bidang'].'-'.$d['Kd_Unit'].'-'.$d['Kd_Sub']]=$nama;
	}


?>
<div class="Kegiatan-skpd-create">
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($mod, 'Kd_Unit')->dropDownList($unit, ['prompt'=>'Pilih Unit'])->label('SKPD')?>

<?= Html::submitButton($mod->isNewRecord ? 'Tampilkan' : 'Update',
	['class' => $mod->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
 <?php ActiveForm::end(); ?>

</div>
<?php

if(!empty($_POST)){
		$mod->load(Yii::$app->request->post());
		$d=explode("-", $mod->Kd_Unit);
		$meIdUrusan=$d[0];
		$meIdBidang=$d[1];
        $meIdSkpd=$d[2];
		$meIdSub=$d[3];

		$cookies = Yii::$app->response->cookies;
        $cookies->add(new \yii\web\Cookie([
            'name' => 'subUnit',
            'value' => $meIdSub,
        ]));

		$cookies->add(new \yii\web\Cookie([
    		'name' => 'skpd',
   		 	'value' => $meIdSkpd,
		]));

		$cookies->add(new \yii\web\Cookie([
    		'name' => 'urusan',
   		 	'value' => $meIdUrusan,
		]));

		$cookies->add(new \yii\web\Cookie([
    		'name' => 'bidang',
   		 	'value' => $meIdBidang,
		]));

$meDataUrusan=$ref->getUrusanOne($meIdUrusan);
$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);

$meDataSub=null;
if($meIdSub!=0){
    $meDataSub=$ref->getSubUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd,$meIdSub);
}
?>
<br>
<div class="ref-kegiatan-index">
    <table class="table table-striped rkaTable">
        <tbody>
            <tr>
                <td class="col-md-2">Urusan Pemerintahan</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?php echo $meIdUrusan.".".$meIdBidang ?>
                </td>
                <td>
                    <?php echo $meDataUrusan->Nm_Urusan." ".$meDataBidang->Nm_Bidang ?>
                </td>
            </tr>
            <tr>
                <td class="col-md-2">Organisasi</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?php if($meDataSub){ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd.".".$meIdSub ?>
                    <?php }else{ ?>
                        <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd ?>
                    <?php } ?>
                </td>
                <td>
                    <?php if($meDataSub){ ?>
                        <?= $meDataSub->Nm_Sub_Unit ?>
                    <?php }else{ ?>
                        <?= $meDataUnit->Nm_Unit ?>
                    <?php } ?>
                </td>
            </tr>
        </tbody>
    </table>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No.'
            ],
            [
                'attribute' =>'Ket_Program',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Cari Nama Program'
                ],
                'format' => 'raw',
                'value' => function($model){
                    $ref=new Referensi;
                    $cookies = Yii::$app->request->cookies;

        			if(!empty($cookies['skpd'])){
                        $meIdUrusan=$cookies['urusan']->value;
                        $meIdBidang=$cookies['bidang']->value;
                        $meIdSkpd=$cookies['skpd']->value;
                        $meIdSub=$cookies['subUnit']->value;
                    }else{
                        $meIdUrusan=Yii::$app->user->identity->id_urusan;
                        $meIdBidang=Yii::$app->user->identity->id_bidang;
                        $meIdSkpd=Yii::$app->user->identity->id_skpd;
                        $meIdSub=Yii::$app->user->identity->id_subunit;
                    }

                    return Html::a($model->Kd_Prog.":".$model->Ket_Program,
                    	['kegiatan', 'id'=>$model->Kd_Prog,
                    	'Kd_Urusan'=>$model->Kd_Urusan, 'Kd_Bidang'=>$model->Kd_Bidang], ['class' => 'btn btn-success  tunder']).
                    Html::a($ref->getKegiatanByCount($meIdUrusan,$meIdBidang,$meIdSkpd,$model->Kd_Prog).
                    ' Kegiatan', ['kegiatan', 'id'=>$model->Kd_Prog], ['class' => 'btn btn-warning']);
                }
            ]
        ],
    ]); ?>
</div>
<?php
}
}
?>