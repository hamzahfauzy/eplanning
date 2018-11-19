<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdSasaran */
/* @var $form yii\widgets\ActiveForm */
$No_Tujuan=array();
?>

<div class="ta-rpjmd-sasaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'No_Misi')->label('Misi')->dropDownList($dataMisi, ['prompt'=>'Pilih Misi', 'id'=>'No_Misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->label('Tujuan')->dropDownList($model->isNewRecord ? $No_Tujuan : $dataTujuan, ['prompt'=>'Pilih Tujuan', 'id'=>'No_Tujuan']) ?>

    <?= $form->field($model, 'No_Sasaran')->textInput(['id'=>'No_Sasaran']) ?>

    <?= $form->field($model, 'Sasaran')->textarea(['rows' => 6]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Edit', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>

<script type="text/javascript">

    $('#No_Misi').change(function(){
        var No_Misi=$(this).val();
        $.post('index.php?r=ta-rpjmd-tujuan/get-tujuan&No_Misi='+No_Misi, function(data){
            //alert(data);
            $('#No_Tujuan').html(data);
        })
    })

    // $('#No_Tujuan').change(function(){
    //     var No_Tujuan=$(this).val();
    //     var No_Misi=$('#No_Misi').val();
    //     $.post('index.php?r=ta-rpjmd-tujuan/get-nomor-sasaran&No_Misi='+No_Misi+'&No_Tujuan='+No_Tujuan, function(data){
    //         $('#No_Sasaran').val(data);
    //     })
    // })

</script>
