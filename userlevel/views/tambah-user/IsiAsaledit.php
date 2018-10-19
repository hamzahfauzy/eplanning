<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$js = "

$('#j_user').change(function(){
	var jenis=$(this).val();
	$.post('".Yii::$app->urlManager->createUrl('ajax/setlevel')."&jenis='+jenis,function(data){
		$('#level').html(data);
	});
	
});

$('#prov').change(function(){
	var prov=$(this).val();
	$.post('".Yii::$app->urlManager->createUrl('ajax/getkab')."&Kd_Prov='+prov,function(data){
		$('#kab').html(data);
	});
});

$('#kab').change(function(){
	var prov=$('#prov').val();
	var kab=$(this).val();
	$.post('".Yii::$app->urlManager->createUrl('ajax/getkec')."&Kd_Prov='+prov+'&Kd_Kab='+kab,function(data){
		$('#kec').html(data);
	});
});	

$('#kec').change(function(){
	var prov=$('#prov').val();
	var kab=$('#kab').val();
	var kec=$(this).val();
	$.post('".Yii::$app->urlManager->createUrl('ajax/getkel')."&Kd_Kec='+kec,function(data){
		$('#kel').html(data);
	});
});

$('#kel').change(function(){
	var prov=$('#prov').val();
	var kab=$('#kab').val();
	var kec=$('#kec').val();
	var kel=$(this).val();
	$.post('".Yii::$app->urlManager->createUrl('ajax/getling')."&Kd_Kec='+kec+'&Kd_Urut_Kel='+kel,function(data){
		$('#ling').html(data);
	});
});

$('#opt input').on('change', function() {
   if ($('input[name=\"TU3Form[opt]\"]:checked').val() == 2){
	   $('#opt1').show();
   }else{
	   $('#opt1').hide();
   }; 
});
";

$this->registerJs($js,4,'my');
//$this->registerJsFile('/esumut/frontend/views/tambah-user/radiobutton.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/* @var $this yii\web\View */
/* @var $model frontend\models\TU3Form */
/* @var $form ActiveForm */
?>
<div class="IsiAsal">

<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

    <?php $form = ActiveForm::begin(); ?>
		<?= $form->field($model, 'opt')->radioList(['1'=>'Provinsi', '2'=>'Kab/Kota'],
		
		['id' => 'opt']); ?>
        <?php /*$form->field($model, 'prov')->dropdownlist($model->getProvinsi(),
		['prompt' => 'Pilih Provinsi',
		'class' => 'dependent-input form-control',
		'id' => 'prov',
		'data-next' => 'kab']
		);
		*/
		 ?>
		<div class="form-option" data-type="class" id="opt1" style="padding-bottom: 10px; display: none">
        <?php 
        /*$form->field($model, 'kab')->dropdownlist([],
		['prompt' => 'Pilih Dahulu Provinsi',
		'class' => 'dependent-input form-control',
		'id' => 'kab',
		'data-next' => 'kec']
		);*/ 
		?>
        <?= $form->field($model, 'kec')->dropdownlist($model->getKec(),
		['prompt' => 'Pilih Dahulu Kota',
		'class' => 'dependent-input form-control',
		'id' => 'kec',
		'data-next' => 'kel']
		); ?>
        <?= $form->field($model, 'kel')->dropdownlist([],
		['prompt' => 'Pilih Dahulu Kecamatan',
		'class' => 'dependent-input form-control',
		'id' => 'kel',
		'data-next' => '']
		); ?>
		<?= $form->field($model, 'ling')->dropdownlist([],
		['prompt' => 'Pilih Dahulu Lingkungan',
		'class' => 'dependent-input form-control',
		'id' => 'ling',
		'data-next' => '']
		); ?>
		</div>
        <?= $form->field($model, 'j_user')->dropdownlist($model->getJenis(),
		['prompt' => 'Pilih Jenis User',
		'class' => 'dependent-input form-control',
		'id' => 'j_user',
		'data-next' => 'level']
		); ?>
        <?= $form->field($model, 'level')->dropdownlist($model->getLevel(),
		['prompt' => 'Pilih Dahulu Jenis User',
		'class' => 'dependent-input form-control',
		'id' => 'level',
		'data-next' => '']
		); ?>
    
        <div class="form-group">
			<?= Html::submitButton('Selesai', [ 'class' => 'btn btn-primary', 'name' => 'selesai']); ?>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'lanjut']) ?>
        </div>
    <?php ActiveForm::end(); ?>
<?php endif; ?>
</div><!-- IsiAsal -->
