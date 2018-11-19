<?php


use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\RefSsh1 */
?>
<div class="ref-ssh1-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Kd_Ssh1',
            'Nm_Ssh1',
        ],
    ]) ?>

</div>

<?php 
	$array = $model->refSsh2s;
 	// print_r($array);
	$Kd_Ssh1 = ArrayHelper::getColumn($array, 'Kd_Ssh1');
	$Kd_Ssh2 = ArrayHelper::getColumn($array, 'Kd_Ssh2');
	$Nm_Ssh2 = ArrayHelper::getColumn($array, 'Nm_Ssh2');
?>

<table class="table table-bordered table-striped">
	<tr class="danger">
		<td>Kd_Ssh2</td>
		<td>Uraian</td>
	</tr>
	<?php
		foreach ($Kd_Ssh1 as $val1);
		foreach ($Kd_Ssh2 as $val2);
		foreach ($Nm_Ssh2 as $val3)
		{ ?>
			<tr>
				<td><?php echo $val1.".".$val2; ?></td>
				<td><?php echo $val3; ?></td>
			</tr>
		<?php } 
	?>
</table>