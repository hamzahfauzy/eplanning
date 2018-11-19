
				<table class="table table-bordered" border="1">
					<thead>
						<tr>
							<th class="vcenter text-center">No</th>
							<th class="vcenter text-center">Unit</th>
							<th class="vcenter text-center">Sub Unit</th>
							<th class="vcenter text-center">Pagu</th>
							<th class="vcenter text-center">Pagu Serapan</th>
							<th class="vcenter text-center">Sisa</th>
						</tr>
						
					</thead>
					<tbody id="isi-wrap">
					<?php
						$no=1;
						foreach ($model as $value) : 
						?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $value->unit->Nm_Unit; ?></td>
							<td><?= $value->sub_unit->Nm_Sub_Unit ?></td>
							<td style="text-align:right;">
								<?php  
								$pagu = $value->pagu;
								echo number_format($pagu,0,".",".");
								?>		
							</td>
						
							<td style="text-align:right;">
								<?php 
								$pagupakai =  $value->getTaBelanjaRincSubs()->sum('Total');
								echo number_format($pagupakai,0,".",".");		
								?></td>
							<td style="text-align:right;">
								<?php $pagu_sisa = $pagu - $pagupakai;
								echo number_format($pagu_sisa,0,".",".");
								?></td>
						</tr>
						<?php 
						endforeach; ?>
						<tr>
							<td></td>
							<td><b>TOTAL</b></td>
							<td></td>
							<td style="text-align:right;"><b>
							<?= number_format($paguIndikatif,0,".",".") ?>	
							</b></td>
							<td style="text-align:right;"><b>
							<?= number_format($pemakaian,0,".",".") ?>
							</b></td>
							<td style="text-align:right;"><b>	
							<?php
							$PaguSisa = $paguIndikatif - $pemakaian;
							echo number_format($PaguSisa,0,".",".");
							?>
							</b></td>

						</tr>
					</tbody>
				</table>