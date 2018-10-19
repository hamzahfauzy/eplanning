<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $model eperencanaan\models\TaMusrenbang */

$this->title = "Penjelasan Program Pembangunan Daerah";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-success">
	<div class="box-header" align="center">
		<h3 class="box-title">Penjelasan Program Pembangunan Daerah</h3>
	</div>
	<div class="box-body">
		<table class="table table-bordered">
			<tr>
				<th rowspan="2">No</th>
				<th rowspan="2">Prioritas Pembangunan</th>
				<th rowspan="2">Program/Pembangunan</th>
				<th colspan="2">Kinerja</th>
				<th rowspan="2">OPD</th>
			</tr>
			<tr>
				<td>Indikator</td>
				<td>Target</td>
			</tr>
			<?php 
				$no = 1; 
				foreach ($model as $val) :
					?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $val->Prioritas_Pembangunan_Daerah ?></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php
				endforeach ;
			?>
		</table>
	</div>
</div>