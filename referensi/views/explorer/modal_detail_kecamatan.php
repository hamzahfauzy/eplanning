<div class="modal-dialog" role="document">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Kecamatan</h4>
      </div>
      <div class="modal-body">
      	<table>
		    	<?php
		    		foreach ($data as $key => $value) {
		    			$Kd_Prov = $value['Kd_Prov'];
		    			$Kd_Kab = $value['Kd_Kab'];
		    			$Kd_Kec = $value['Kd_Kec'];
		    			$Nm_Kec = $value['Nm_Kec'];
							$kelurahan= $value->getRefKelurahans()->count();
		    			//$jlh_lingkungan = $value->lingkungans->count();
		    			echo "
		    				<tr>
		    					<td>Kode Prov</td>
		    					<td>=</td>
		    					<td>$Kd_Prov</td>
		    				</tr>
		    				<tr>
		    					<td>Kode Kab</td>
		    					<td>=</td>
		    					<td>$Kd_Kab</td>
		    				</tr>
		    				<tr>
		    					<td>Kode Kec</td>
		    					<td>=</td>
		    					<td>$Kd_Kec</td>
		    				</tr>
		    				<tr>
		    					<td>Nama Kec</td>
		    					<td>=</td>
		    					<td>$Nm_Kec</td>
		    				</tr>
		    				<tr>
		    					<td>Jumlah Kelurahan</td>
		    					<td>=</td>
		    					<td>$kelurahan</td>
		    				</tr>
		    			";
		    		}
		    	?>
      	</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      </div>
  </div>
</div>