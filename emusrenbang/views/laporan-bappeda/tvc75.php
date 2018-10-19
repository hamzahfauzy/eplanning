<?php

use yii\helpers\Html;

$this->title = 'Prioritas Pembangunan Daerah';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title"></h3>
	</div>
	<div class="box-body">
		<table class="table table-bordered">
			<tr>
				<th>No</th>
				<th>Program Prioritas Tahun Rencana (RPJMD)</th>
				<th>Prioritas Pembanguan daerah (RKPD)</th>
			</tr>
			<?php
				$no = 1;  
				foreach ($data as $value) :
					?>
					<tr>
						<td><?= @$no++ ?></td>
						<td><?= @$value->refProgram['Nm_Program'] ?></td>
						<td><?= @$value->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah ?></td>
					</tr>
					<?php
				endforeach ;
			?>
		</table>
	</div>
</div>