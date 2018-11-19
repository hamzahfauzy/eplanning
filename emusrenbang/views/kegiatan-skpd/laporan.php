<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\RefUnit;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KegiatanSkpdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Rencana Kerja';
$this->params['breadcrumbs'][] = "Laporan";
$this->params['breadcrumbs'][] = $this->title;



?>
<?php $form = ActiveForm::begin(); ?>

<?=$form->field($model,'Kd_Unit')->dropDownList($dataTahun,['prompt'=>'Pilih  Tahun'])->label("Tahun Anggaran")?>

<?=$form->field($model, 'Kd_Unit')->dropDownList($dataSkpd, ['prompt'=>'Pilih  SKPD']) ?>

<?php $form = ActiveForm::end(); ?>
<?
//print_r($dataSkpd);
//print_r($model);
?>
<div class="kegiatan-skpd-laporan">
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td rowspan="2" class="vcenter text-center">No</td>
			<td rowspan="2" class="vcenter text-center">Program Kegiatan</td>
			<td rowspan="2" class="vcenter text-center">Sasaran Kegiatan</td>
			<td colspan="2" class="vcenter text-center">Target</td>
			<td colspan="2" class="vcenter text-center">Pagu Indikatif</td>
			<td rowspan="2" class="vcenter text-center">Perubahan (-/+) (Rp)</td>
		</tr>
		<tr>
			<td class="vcenter text-center">Volume</td>
			<td class="vcenter text-center">Satuan</td>
			<td class="vcenter text-center">Sebelum Perubahan (Rp)</td>
			<td class="vcenter text-center">Sesudah Perubahan (Rp)</td>

		</tr>
		<tr>
			<td class="text-center">(1)</td>
			<td class="text-center">(2)</td>
			<td class="text-center">(3)</td>
			<td class="text-center">(4)</td>
			<td class="text-center">(5)</td>
			<td class="text-center">(6)</td>
			<td class="text-center">(7)</td>
			<td class="text-center">(8)</td>
		</tr>
	</thead>
</table>
</div>
