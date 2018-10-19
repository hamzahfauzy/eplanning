<?php

use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh4 */
?>
<div class="ref-ssh4-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'kdSsh1.kdSsh1.kdSsh1.Nm_Ssh1',
            'kdSsh1.kdSsh1.Nm_Ssh2',
            'kdSsh1.Nm_Ssh3',
            'Nm_Ssh4',
            'kode',
        ],
    ]) ?>

</div>

<?php 
    $array = $model->refSsh5s;

    $Kd_Ssh1 = ArrayHelper::getColumn($array, 'Kd_Ssh1');
    $Kd_Ssh2 = ArrayHelper::getColumn($array, 'Kd_Ssh2');
    $Kd_Ssh3 = ArrayHelper::getColumn($array, 'Kd_Ssh3');
    $Kd_Ssh4 = ArrayHelper::getColumn($array, 'Kd_Ssh4');
    $Kd_Ssh5 = ArrayHelper::getColumn($array, 'Kd_Ssh5');
    $Nm_Ssh5 = ArrayHelper::getColumn($array, 'Nm_Ssh5');
?>

<table class="table table-bordered table-striped">
    <tr class="danger">
        <td>Kd_Ssh5</td>
        <td>Uraian</td>
    </tr>
    <?php
        foreach ($Kd_Ssh1 as $val1);
        foreach ($Kd_Ssh2 as $val2);
        foreach ($Kd_Ssh3 as $val3);
        foreach ($Kd_Ssh4 as $val4);
        foreach ($Kd_Ssh5 as $val5);
        foreach ($Nm_Ssh5 as $val6)
        { ?>
            <tr>
                <td><?php echo $val1.".".$val2.".".$val3.".".$val4.".".$val5; ?></td>
                <td><?php echo $val6; ?></td>
            </tr>
        <?php } 
    ?>
</table>