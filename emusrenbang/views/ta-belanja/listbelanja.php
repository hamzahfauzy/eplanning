<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\RefProgram;

$user = Yii::$app->levelcomponent->getUnit();
$cookies = Yii::$app->request->cookies;

if(!empty($cookies['skpd'])){
  $meIdUrusan=$cookies['urusan']->value;
  $meIdBidang=$cookies['bidang']->value;
}else{
  $meIdUrusan=$user->Kd_Urusan;
  $meIdBidang=$user->Kd_Bidang;
  $meIdUnit=$user->Kd_Unit;
  $meIdSub=$user->Kd_Sub_Unit;
}

$this->title = 'Usulan Kegiatan Tahun'.$model->Tahun;
$this->params['breadcrumbs'][] = ['label' => 'Program Usulan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ta-belanja-index">
  <div class="box box-success">
    <div class="box-body">
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
                <td>
                </td>
            </tr>
                
            <!-- Sinkornasi Program -- >
            <tr>
                    <td class="col-md-2">Prioritas Nasional</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-md-2">Nawacita</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-md-2">Urusan Pembangunan</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td class="col-md-2">Misi Pembangunan</td>
                    <td class="col-md-0 padding-edge">:</td>
                    <td colspan="2"></td>
                </tr>
        </tbody>
    </table>
    </div>
  </div>
</div>