<?php

use yii\helpers\Html;
use app\models\Referensi;
use yii\widgets\ActiveForm;
$ref=new Referensi();

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */

$this->title = 'Monitoring Kegiatan SKPD';
$this->params['breadcrumbs'][] = $this->title;
$unit=array();
foreach($modelUnit as $d){
    $unit[$d['Kd_Urusan'].'-'.$d['Kd_Bidang'].'-'.$d['Kd_Unit']]=$d['Nm_Unit'];
}

$js="
$('#pen-').click(function(){
	alert($('#pen-').attr('name'));
	alert($('#pen-').text());
	$.post('index.php?r=ajax/modaldata&urusan='+urusan+'&bidang='+bidang, function(data, status){
        $('#kdprog').html(data);
    })
});
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
//UIExtendedModals.init('index.php?r=ajax/modaltest&id=test');

";

$this->registerJs($js, 4, 'my-options');

?>
<div class="kegiatan-skpd-create">
<?php

$form = ActiveForm::begin();
echo $form->field($model, 'Kd_Unit')->dropDownList($unit, ['prompt'=>'Pilih Unit'])->label('SKPD');

echo Html::submitButton($model->isNewRecord ? 'Tampilkan' : 'Update',
	['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'id'=>'proses']);
ActiveForm::end();
?>
</div>


<div id="responsive" class="modal fade" tabindex="-1" data-width="760">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Penilaian</h4>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div id='data'>

				</div>
			</div>

		</div>
	</div>
	<div class="modal-footer">
		<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
	</div>
</div>

<?php
if($modelTa!==0){
?>
<br />
<br />
<?php $form = ActiveForm::begin(); ?>
<table class="table">
<thead>
    <tr>
        <th>No</th>
        <th>Program</th>
        <th>Kegiatan</th>
        <th>Lokasi</th>
        <th>Sasaran</th>
        <th>Pagu</th>
        <th>Verifikasi</th>
    </tr>
</thead>
<tbody>
<?php
$d=explode("-", $model->Kd_Unit);
            $urusan=$d[0];
            $bidang=$d[1];
            $unit=$d[2];
            $u=$urusan.'-'.$bidang.'-'.$unit;
            ?>
            <?= $form->field($model, 'Kd_Unit')->hiddenInput(['value'=>$u])->label('SKPD')?>
<?php
$i=1;

foreach($modelTa as $data){
    $model->verifikasi[$data['Kd_Prog']][$data['Kd_Keg']][]=$data['Status'];
?>
    <tr>
        <td><?=$i;?></td>
        <td><?= $data['Ket_Program']; ?></td>
        <td><?= $data['Ket_Kegiatan']; ?></td>
        <td><?= $data['Lokasi'] ?></td>
        <td><?= $data['Kelompok_Sasaran']; ?></td>
        <td><?= number_format($data['Pagu_Anggaran']); ?></td>
        <td><a class="btn default" data-toggle="modal" href="#responsive" id='pen-<?= $data['Kd_Prog']; ?>-<?= $data['Kd_Keg']; ?>' name='dani'>Penilaian</a></td>
    </tr>
<?php
$i=$i+1;
}
?>
</tbody>
</table>
<?php //Html::submitButton($model->isNewRecord ? 'Proses' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'name'=>'proses']) ?>
 <?php ActiveForm::end(); ?>
<?php
}
?>
