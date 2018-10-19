<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TaPaguProgram */

$this->title = "Pagu Indikatif Program";
$this->params['breadcrumbs'][] = "Pagu Indikatif";
$this->params['breadcrumbs'][] = $this->title;
$js="


";
$this->registerJs($js, 4, 'My');
?>

<style>
    #jlh_pagu {
        text-align: right;
    }
</style>

<div class="ta-pagu-program-view">
    <div class="">
        <div class="box-body">
            <div class="col-md-12">
                <div class="form-group">
                    <h5 class="control-label col-md-3"><strong>Pagu Indikatif SKPD</strong></h5>
                    <input type="text" id="jlh_pagu" value="<?= $jlh_pagu ?>" disabled>
                </div>
                <div class="form-group">
                    <h5 class="control-label col-md-3"><strong>Sisa Pagu Indikatif SKPD</strong></h5>
                    <input type="text" class="" value="" readonly="">
                </div>
            </div>
            
            <?php $form = ActiveForm::begin(); ?>
                <table class='table table-hover table-bordered'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Program</th>
                            <th>Pagu Indikatif Program</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=1;
                            foreach($pagusubunit as $val) { ?>
                            <tr>
                                <td><?= $i++?></td>
                                <td></td>
                                <td><input type="text" name="" id="" value="<?= $val->pagu ?>" class="form-control"></td>
                            </tr>
                            <?php }
                        ?>
                    </tbody>
                </table>
                <div id='n' style='display:none'><?=$i;?></div>
                <input type='hidden' id='total'>
                <div class="form-group">
                        <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary', 'id'=>'tmbl']) ?>
                    </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>