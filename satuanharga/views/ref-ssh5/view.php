<?php

use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh5 */
?>
<div class="ref-ssh5-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdSsh1.kdSsh1.kdSsh1.kdSsh1.Nm_Ssh1',
            'kdSsh1.kdSsh1.kdSsh1.Nm_Ssh2',
            'kdSsh1.kdSsh1.Nm_Ssh3',
            'kdSsh1.Nm_Ssh4',
            'Nm_Ssh5',
            'kode',
        ],
    ]) ?>

</div>


<?php 
    $array = $model->refSshes;
    $Kd_Ssh1 = ArrayHelper::getColumn($array, 'Kd_Ssh1');
    $Kd_Ssh2 = ArrayHelper::getColumn($array, 'Kd_Ssh2');
    $Kd_Ssh3 = ArrayHelper::getColumn($array, 'Kd_Ssh3');
    $Kd_Ssh4 = ArrayHelper::getColumn($array, 'Kd_Ssh4');
    $Kd_Ssh5 = ArrayHelper::getColumn($array, 'Kd_Ssh5');
    $Kd_Ssh6 = ArrayHelper::getColumn($array, 'Kd_Ssh6');
    $Nama_Barang = ArrayHelper::getColumn($array, 'Nama_Barang');
?>

<table class="table table-bordered table-striped">
    <tr class="danger">
        <td>Kd_Ssh6</td>
        <td>Nama Barang</td>
    </tr>
    <?php
        foreach ($Kd_Ssh1 as $val1);
        foreach ($Kd_Ssh2 as $val2);
        foreach ($Kd_Ssh3 as $val3);
        foreach ($Kd_Ssh4 as $val4);
        foreach ($Kd_Ssh5 as $val5);
        foreach ($Kd_Ssh6 as $val6);
        foreach ($Nama_Barang as $val7)
        { ?>
            <tr>
                <td><?php echo $val1.".".$val2.".".$val3.".".$val4.".".$val5.".".$val6; ?></td>
                <td><?php echo $val7; ?></td>
            </tr>
        <?php } 
    ?>
</table>