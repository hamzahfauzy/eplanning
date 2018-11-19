<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LevelAssignment */
/* @var $form yii\widgets\ActiveForm */
$dataAplikasi=$this->context->getLevelaplikasi();
$dataFungsi=$this->context->getLevelfungsi();
$dataUser=$this->context->getUser();

$js="

    $('#id_user').change(function(){
        $(':checkbox').prop('checked', false);
        id=$('#id_user').val();
        //$('input[type=checkbox]')

        $.getJSON('index.php?r=level-assignment/getlevel&id='+id, function(data){
                    $.each( data, function( key, val ) {
                        $('#'+val).prop('checked',true);
                    });
        });
    });
";

$this->registerJs($js,4,'level');

?>

<div class="level-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->dropDownList($dataUser, ['prompt'=>'Pilih User', 'id'=>'id_user']) ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Aplikasi</th>
                <?php
                foreach($dataFungsi as $dFungsi){
                    echo "<th>$dFungsi</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody>

        <?php
        $i=1;
        foreach($dataAplikasi as $k=>$dAplikasi){
            echo "<tr>
                        <td>$i</td>
                        <td>$dAplikasi</td>";
            foreach($dataFungsi as $kf=>$fungsi){
                echo "<td><input type='checkbox' value='1' name='LevelAssignment[d.$k.$kf]' id='d$k$kf'></td>";
            }
            echo "</tr>";
            $i=$i+1;
        }
        ?>
        </tbody>
    </table>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
