<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TaRpjmdProgramPrioritas */
/* @var $form yii\widgets\ActiveForm */
$No_Tujuan = [];
$No_Sasaran = [];
$Kd_Bidang = [];
$Kd_Prog = [];

$this->title = ($model->isNewRecord ? 'Tambah' : ' Edit').' Program Prioritas';

$this->registerCssFile(
        '@web/plugins/select2/select2.css'
);

$this->registerJsFile(
        '@web/js/rpjmd.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/plugins/select2/select2-bootstrap.css'
);

$this->registerJsFile(
        '@web/plugins/select2/select2.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/js/tabel_style.css',
        ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>

<div class="ta-rpjmd-program-prioritas-form">

    <?php $form = ActiveForm::begin(); ?>

    <!--<?= $form->field($model, 'Tahun')->textInput(['maxlength' => true]) ?>-->

    <?= $form->field($model, 'No_Misi')->label('Misi')->dropDownList($dataMisi, ['prompt'=>'Pilih Misi', 'id'=>'No_Misi']) ?>

    <?= $form->field($model, 'No_Tujuan')->label('Tujuan')->dropDownList($model->isNewRecord ? $No_Tujuan : $dataTujuan, ['prompt'=>'Pilih Tujuan', 'id'=>'No_Tujuan']) ?>

    <?= $form->field($model, 'No_Sasaran')->label('Sasaran')->dropDownList($model->isNewRecord ? $No_Sasaran : $dataSasaran, ['prompt'=>'Pilih Sasaran', 'id'=>'No_Sasaran']) ?>

    <?= $form->field($model, 'No_Prioritas')->label('Prioritas')->dropDownList($dataPrioritas, ['prompt'=>'Pilih Prioritas', 'id'=>'No_Prioritas']) ?>

    <?= $form->field($model, 'Kd_Prog')->label('Program')->dropDownList($dataProgram, ['prompt'=>'Pilih Program', 'id'=>'Kd_Prog',  'class'=>'form-control selects']) ?>

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
        $.post('index.php?r=ta-rpjmd-program-prioritas/get-tujuan&No_Misi='+No_Misi, function(data){
            //alert(data);
            $('#No_Tujuan').html(data);
        })
    })

    $('#No_Tujuan').change(function(){
        var No_Misi=$('#No_Misi').val();
        var No_Tujuan=$(this).val();
        $.post('index.php?r=ta-rpjmd-program-prioritas/get-sasaran&No_Misi='+No_Misi+'&No_Tujuan='+No_Tujuan, function(data){
            //alert(data);
            $('#No_Sasaran').html(data);
        })
    })

$(".selects").select2({
  allowClear: true
});

</script>