<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Misi */

$this->title = 'Tambah Kegiatan';
$this->params['breadcrumbs'][] = $this->title;




// $this->registerCssFile(
//         '@web/plugins/select2/select2.css', ['depends' => [\yii\web\JqueryAsset::className()]]
// );

// $this->registerJsFile(
//         '@web/plugins/select2/select2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
// );
$url = ['monitoring-prov/keterangan-kegiatan-proses',
				'Tahun' => $Tahun,
				'Kd_Urusan' => $Kd_Urusan,
				'Kd_Bidang' => $Kd_Bidang,
				'Kd_Unit' => $Kd_Unit,
				'Kd_Sub' => $Kd_Sub,
				'Kd_Prog' => $Kd_Prog,
				'Kd_Keg' => $Kd_Keg,
	];

?>
<div class="misi-form">
  <?php $form = ActiveForm::begin(['action' =>$url,'id' => 'keterangan_kegiatan_form']); ?>
		<?= $form->field($model, 'Keterangan_Verifikasi_Bappeda')->textarea(['rows' => '3']) ?>
  	<?php // echo Html::submitButton('Tambah' , ['class' => 'btn btn-success' ]) ?>
  <?php ActiveForm::end(); ?>
	
</div>


<script type="text/javascript">
</script>