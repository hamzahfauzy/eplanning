<?php

use yii\helpers\Html;

$this->title = 'Prioritas Pembangunan Daerah';

?>		

<table class="table table-bordered">
	<caption class="headerFox text-center">
        <h3><?= $this->title." - ".$skpd->Nm_Sub_Unit ?></h3>
    </caption>
    <thead>
    	<tr>
			<th>No</th>
			<th>Program Prioritas Tahun Rencana (RPJMD)</th>
			<th>Prioritas Pembanguan daerah (RKPD)</th>
		</tr>
    </thead>
	<tbody>
		<?php
			$no = 1;  
			foreach ($model as $value) :
				?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $value->refProgram->Ket_Program ?></td>
					<td><?= $value->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah ?></td>
				</tr>
				<?php
			endforeach ;
		?>
	</tbody>
</table>