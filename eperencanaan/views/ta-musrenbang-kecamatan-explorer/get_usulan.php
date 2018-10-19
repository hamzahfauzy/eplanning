<?php
	$no=0;  
	foreach ($data as $value) { $no++; ?>
		<tr>
			<td><?= $no."." ?></td>
			 <td><?= $value->Jenis_Usulan ?></td>
		</tr>
	<?php }
?>

