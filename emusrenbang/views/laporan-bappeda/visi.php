<?php

use yii\helpers\Html;

$this->title = 'Visi dan Pejabat';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title"><?= $this->title." - ".$skpd->Nm_Sub_Unit ?></h3>
	</div>
	<div class="box-body">
		<table class="table table-bordered">
			<tr>
				<th>No</th>
				<th>Nama Pimpinan</th>
				<th>Nip Pimpinan</th>
				<th>Jabatan Pimpinan</th>
				<th>Alamat</th>
				<th>Visi</th>
			</tr>
			<?php
				$no = 1;  
				foreach ($model as $value) :
					?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $value->Nm_Pimpinan ?></td>
						<td><?= $value->Nip_Pimpinan ?></td>
						<td><?= $value->Jbt_Pimpinan ?></td>
						<td><?= $value->Alamat ?></td>
						<td><?= $value->Ur_Visi ?></td>
					</tr>
					<?php
				endforeach ;
			?>
		</table>
	</div>
</div>