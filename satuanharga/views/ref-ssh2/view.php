<?php

use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\RefSsh2 */
?>
<div class="ref-ssh2-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        	'kdSsh1.Nm_Ssh1',
        	'Nm_Ssh2',
        	'kode',
        ],
    ]) ?>

</div>

<?php
	$array = $model->refSsh3s;
	$Kd_Ssh1 = ArrayHelper::getColumn($array, 'Kd_Ssh1');
	$Kd_Ssh2 = ArrayHelper::getColumn($array, 'Kd_Ssh2');
	$Kd_Ssh3 = ArrayHelper::getColumn($array, 'Kd_Ssh3');
	$Nm_Ssh3 = ArrayHelper::getColumn($array, 'Nm_Ssh3');
?>

<table class="table table-bordered table-striped">
	<tr class="danger">
		<td>Kd_Ssh3</td>
		<td>Uraian</td>
	</tr>
	<?php
		foreach ($Kd_Ssh1 as $val1);
		foreach ($Kd_Ssh2 as $val2);
		foreach ($Kd_Ssh3 as $val3);
		foreach ($Nm_Ssh3 as $val4)
		{ ?>
			<tr>
				<td><?php echo $val1.".".$val2.".".$val3; ?></td>
				<td><?php echo $val4; ?></td>
			</tr>
		<?php }
	?>
</table>
