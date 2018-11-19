<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RefKecamatanKriteriaPembobotan */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
    $("#tambah_bobot").click(function(){
			var isi = $("#bobot_isi").html();

			$("#bobot_wrap").append(isi);

		});
JS;
$this->registerJs($script);

?>

<div class="ref-forum-kriteria-pembobotan-form">

  <?php $form = ActiveForm::begin(); ?>
		<div class="row">
      <div class="col-md-12">
        <?= $form->field($model, 'Kriteria')->textInput() ?>
      </div>
      <div class="col-md-12">
	    	<?= $form->field($model, 'Bobot')->textInput() ?>
      </div>
      <div class="col-md-12">
	    	<?= $form->field($model, 'Keterangan_Kriteria')->textarea(['rows' => 2]) ?>
      </div>
		</div> <!-- end of row -->
		<hr/>
		<h2>Bobot</h2>
		<div id="bobot_wrap">
		<?php foreach ($dataBobot as $value): ?>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
				    <label >Range</label>
				    <input type="text" name="range[]" class="form-control" value="<?=$value['Range'];?>">
				  </div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
				    <label >Skor</label>
				    <input type="text" name="skor[]" class="form-control" value="<?=$value['Skor'];?>">
				  </div>
				</div>
			</div> 
		<?php endforeach; ?>
		</div> <!--akan diisi dengan bobot-->
		<button type="button" class="btn btn-primary" id="tambah_bobot">+</button>
			<?php if (!Yii::$app->request->isAjax){ ?>
			  	<div class="form-group">
			        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
			    </div>
			<?php } ?>
  <?php ActiveForm::end(); ?>
    
</div>

<div id="bobot_isi" style="display:none">
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
		    <label >Range</label>
		    <input type="text" name="range[]" class="form-control" placeholder="Range">
		  </div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
		    <label >Skor</label>
		    <input type="text" name="skor[]" class="form-control" placeholder="Skor">
		  </div>
		</div>
	</div> <!-- end of row -->
</div>


