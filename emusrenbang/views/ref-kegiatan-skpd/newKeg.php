<?php

use yii\helpers\Html;
use app\models\Referensi;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KegiatanSkpd */
/* @var $form yii\widgets\ActiveForm */

// $ref=new Referensi;
// $meIdUrusan=Yii::$app->user->identity->id_urusan;
// $meIdBidang=Yii::$app->user->identity->id_bidang;
// $meIdSkpd=Yii::$app->user->identity->id_skpd;

// $meDataUrusan=$ref->getUrusanOne($meIdUrusan);
// $meDataBidang=$ref->getBidangOne($meIdUrusan,$meIdBidang);
// $meDataUnit=$ref->getUnitOne($meIdUrusan,$meIdBidang,$meIdSkpd);


$user = Yii::$app->levelcomponent->getUnit();

  $cookies = Yii::$app->request->cookies;
 
    $meIdUrusan=$user->Kd_Urusan;
    $meIdBidang=$user->Kd_Bidang;
    $meIdUnit=$user->Kd_Unit;
    $meIdSub=$user->Kd_Sub_Unit;


$this->title = $nameTag;
$this->params['breadcrumbs'][] = ['label' => 'Program Usulan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Usulan Kegiatan', 'url' => ['kegiatan', 'id'=>$KdProg]];
$this->params['breadcrumbs'][] = $nameAction;

?>
<div class="ref-kegiatan-create">

    <table class="table table-striped rkaTable">
        <tbody>
             <tr>
                <td class="col-md-2">Urusan</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >

                   <?php
                    foreach ($modelUnit as $data) : ?>                     
                    <?php echo $data->Kd_Urusan; ?> 
                </td>
                <td>
                    <?php echo $data->urusan->Nm_Urusan; ?>
                </td>
                   
                    <?php endforeach; ?>

                </td>
                <td>
                    
                </td>
            </tr>
             <tr>
                <td class="col-md-2">Bidang</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                   <?php
                    foreach ($modelUnit as $data) : ?>                     
                    <?php echo $data->Kd_Urusan.".".$data->Kd_Bidang; ?> 
                </td>
                <td>
                    <?php echo $data->kdBidang->Nm_Bidang; ?>
                </td>
                   
                    <?php endforeach; ?>
                </td>
                <td>
                    
                </td>
            </tr>

             <tr>
                <td class="col-md-2">Unit</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                   <?php
                    foreach ($modelUnit as $data) : ?>                     
                    <?php echo $data->Kd_Urusan.".".$data->Kd_Bidang.".".$data->Kd_Unit; ?> 
                </td>
                <td>
                    <?php echo $data->kdUrusan->Nm_Unit; ?>
                </td>
                   
                    <?php endforeach; ?>
                </td>
                <td>
                    
                </td>
            </tr>

             <tr>
                <td class="col-md-2">Sub Unit</td>
                <td class="col-md-0 padding-edge">:</td>
                <td>
                   <?php foreach ($modelUnit as $data) : ?> 
                    
                    <?php echo $data->Kd_Urusan.".".$data->Kd_Bidang.".".$data->Kd_Unit.".".$data->Kd_Sub; ?> 
                    </td>
                    <td>
                     <?php echo $data->namaSub->Nm_Sub_Unit; ?>
                    </td>
                   
                    <?php endforeach; ?>
                </td>
                <td>
                   
                </td>
            </tr>
            
            <tr>
                <td class="col-md-2">Program</td>
                <td class="col-md-0 padding-edge">:</td>
                <td >
                    <?= $meIdUrusan.".".$meIdBidang.".".$meIdUnit.".".$meIdSub.".".$KdProg; ?>
                </td>
                <td>
                    <?= $ketProgram ?>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="ref-program-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'Kd_Keg')->textInput(['value'=>$kp, 'id'=>'Kd_Keg'])->label("Kode Usulan Kegiatan") ?>

        <?= $form->field($model, 'Ket_Kegiatan')->textInput(['id'=>'Ket_Kegiatan'])->label("Usulan Kegiatan") ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Tambah' : 'Ubah', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
