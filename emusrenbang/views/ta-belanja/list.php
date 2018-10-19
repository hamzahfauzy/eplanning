<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;
use app\models\RefUnit;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RefKegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $ref=new Referensi;
$idLevel=Yii::$app->user->identity->id_level;
$username=Yii::$app->user->identity->username;


if($idLevel==8){
	$modelUnit=RefUnit::find()->leftJoin('level_unit', 'level_unit.Kd_Urusan=Ref_Unit.Kd_Urusan and level_unit.Kd_Bidang=Ref_Unit.Kd_Bidang and level_unit.Kd_Unit=Ref_Unit.Kd_Unit')
            ->select(['Ref_Unit.*'])->where(['level_unit.username'=>$username])->all();
	$unit=array();
	foreach($modelUnit as $d){
    	$unit[$d['Kd_Urusan'].'-'.$d['Kd_Bidang'].'-'.$d['Kd_Unit']]=$d['Nm_Unit'];
	}
?>
<div class="kegiatan-skpd-create">
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($mod, 'Kd_Unit')->dropDownList($unit, ['prompt'=>'Pilih Unit'])->label('SKPD')?>

<?= Html::submitButton($mod->isNewRecord ? 'Tampilkan' : 'Update',
	['class' => $mod->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']) ?>
 <?php ActiveForm::end(); ?>

</div>
<br>
<?php
	if(!empty($_POST)){
		$mod->load(Yii::$app->request->post());
		$d=explode("-", $mod->Kd_Unit);
		$meIdUrusan=$d[0];
		$meIdBidang=$d[1];
		$meIdSkpd=$d[2];
		$meIdSub=$d[2];

		$cookies = Yii::$app->response->cookies;
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
	}
}
$cookies = Yii::$app->request->cookies;

if(!empty($cookies['skpd'])){
	$meIdUrusan=$cookies['urusan']->value;
	$meIdBidang=$cookies['bidang']->value;
	$meIdSkpd=$cookies['skpd']->value;
	$meIdSub=$cookies['skpd']->value;
}else{
	$meIdUrusan=Yii::$app->user->identity->id_urusan;
	$meIdBidang=Yii::$app->user->identity->id_bidang;
	$meIdSkpd=Yii::$app->user->identity->id_skpd;
	$meIdSub=Yii::$app->user->identity->id_subunit;
}



$meDataUrusan=$ref->getUrusanOne($meIdUrusan);
$meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
$meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);


$this->title = 'Kegiatan  Musrenbang';
$this->params['breadcrumbs'][] = "Rencana Kerja";
$this->params['breadcrumbs'][] = 'Data Program';

if(!empty($cookies['skpd']) or !empty($meIdBidang)){
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
                <td >
                    <?= $meIdUrusan.".".$meIdBidang.".".$meIdSkpd ?>
                </td>
                <td>
                    <?php echo $meDataUnit->Nm_Unit ?>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="pagu pull-right">
        <tr>
            <td>Pagu Indikatif SKPD</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= number_format($paguUnit,0,',','.') ?></td>
        </tr>
        <tr>
            <td>Sisa Pagu Indikatif SKPD</td>
            <td class="dot">:</td>
            <td class="vPagu"><?= number_format($paguSisa,0,',','.') ?></td>
        </tr>
    </table>
    <div class="clearfix"></div>
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
                    return Html::a($model->Kd_Prog.":".$model->Ket_Program, ['listkegiatan', 'id'=>$model->Kd_Prog], ['class' => 'btn btn-success  tunder']).
                    Html::a($ref->getKegiatanByCount($model->Kd_Urusan,$model->Kd_Bidang,$meIdSkpd,$model->Kd_Prog).' Kegiatan', ['listkegiatan', 'id'=>$model->Kd_Prog], ['class' => 'btn btn-warning']);
                }
            ],
            [
                'attribute' =>'Pagu Indikatif',
                'format' => 'raw',
                'value' => function($model){
                    $ref=new Referensi;
                    $unit=Yii::$app->user->identity->id_skpd;
                    return "<div class='text-right'>".$ref->getPaguProgram($model->Kd_Prog)."</div>";
                }
            ]
        ],
    ]); ?>
</div>
<?php
}
?>