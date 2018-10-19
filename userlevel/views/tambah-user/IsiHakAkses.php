<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\Session;
$js="
$('#provchkbox input').on('change', function() {
	var d=$('input[name=\'TU4Form[chk][]\']:checked');
   if (d.val() == 1){
	   $('#kota').show();
   }else{
	   $('#kota').hide();
   }; 
});
";

$this->registerJs($js,4,'Js');
/* @var $this yii\web\View */
/* @var $model frontend\models\TU4Form */
/* @var $form ActiveForm */
?>
<div class="IsiHakAkses">

    <?php $form = ActiveForm::begin(); ?>
		<?php if ($prov == 1): ?> <?= $form->field($model, 'chk')->checkboxList(['1' => 'Masukkan Kab/Kota'],
		[ 'id' => 'provchkbox'
		]
		);?> 
		<?php endif;?>
		<div class="form-option" data-type="class" id="kota" style="padding-bottom: 10px; display: none">
		<?= $form->field($model, 'kota')->dropdownlist($model->getKota($prov),
		['prompt' => 'Pilih Kab/Kota'
		]
		); ?>
		</div>
		<div class="form-option" data-type="class" id="opt1" style="padding-bottom: 10px;">
        <?= $form->field($model, 'optk1')->dropdownlist($model->getUnit(),
		['prompt' => 'Pilih Unit', 'class' => 'unit form-control', 'next-data' => 'sub',
		'onchange' => '(function(){var value = $(".unit").val(), next = $(".unit").attr("next-data");
						$.post({url: "' . Yii::$app->urlManager->createUrl('tambah-user/sub-unit') . '",
						data: {value: value, next: next},
						type: "POST",
						success: function(data) {
							$("#" + next).html(data);
		}})}());'
		]
		); ?>
		
		 </div>
		 <div class="form-option" data-type="class" id="opt2"  style="padding-bottom: 10px;">
        <?= $form->field($model, 'optk2')->dropdownlist([],
		['prompt' => 'Pilih Sub Unit', 'id' => 'sub'
		]
		); ?>
		
		</div>
        
    
        <div class="form-group">
			
		<?= Html::submitButton('Selesai', [ 'class' => 'btn btn-primary', 'name' => 'selesai' ]); ?>
		
            <?= Html::submitButton('Tambah', ['class' => 'btn btn-primary', 'name' => 'lanjut']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- IsiHakAkses -->
