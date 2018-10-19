<table class="table table-bordered table-striped">
								<tr style="background:#eaeaea;">
									<th rowspan="3">No</th>
									<th rowspan="3" style="text-align:center">Kecamatan</th>
									<th colspan="7" style="text-align:center">Musrenbang Desa/Kelurahan</th>
									<th colspan="6" style="text-align:center">Musrenbang Kecamatan</th>
									<!--<th colspan="3" style="text-align:center">Pokir</th>-->
								</tr>
								<tr style="background:#eaeaea;">
									<th colspan="3" style="text-align:center">Total</th>
									<th colspan="2" style="text-align:center">Diteruskan</th>
									<th colspan="2" style="text-align:center">Ditolak/Belum Proses</th>
									<th colspan="2" style="text-align:center">Total</th>
									<th colspan="2" style="text-align:center">Diteruskan</th>
									<th colspan="2" style="text-align:center">Ditolak/Belum Proses</th>
									<!--<th rowspan="2" style="text-align:center">Total</th>
									<th rowspan="2" style="text-align:center">Diteruskan</th>
									<th rowspan="2" style="text-align:center">Ditolak/Belum Proses</th> -->
								</tr>
								<tr style="background:#eaeaea;">
									<th style="text-align:center">Desa/Kel</th>
									<th style="text-align:center">Jlh</th>
									<th style="text-align:center">Perk. Biaya (Rp)</th>
									<th style="text-align:center">Jlh</th>
									<th style="text-align:center">Perk. Biaya (Rp.)</th>
									<th style="text-align:center">Jlh</th>
									<th style="text-align:center">Perk. Biaya (Rp.)</th>
									<th style="text-align:center">Jlh</th>
									<th style="text-align:center">Perk. Biaya (Rp.)</th>
									<th style="text-align:center">Jlh</th>
									<th style="text-align:center">Perk. Biaya (Rp.)</th>
									<th style="text-align:center">Jlh</th>
									<th style="text-align:center">Perk. Biaya (Rp.)</th>
								</tr>
								
								<?php 
								$totalDesa = 0;
								$totalUsulanDesa = 0;

								$totalUsulanDesaTerusan = 0;
								$totalUsulanDesaTolak = 0;
								$totalbiayakel = 0;$totalbiayadesaterus=0;$totalbiayadesatolak=0;

								$totalUsulanKecamatan = 0;
								$totalUsulanKecamatanTerusan = 0;
								$totalUsulanKecamatanTolak = 0;
								$totalbiayaKecamatan=0;$totalbiayakecterus=0;$totalbiayakectolak=0;
								$totalUsulanPokir = 0;
								$totalUsulanPokirTerusan = 0;
								$totalUsulanPokirTolak = 0;
								$no=1;
								foreach($dataKec as $kec){
									$totalDesa += $datakel($kec['Kd_Kec']);
									$totalUsulanDesa += $usulanperkel($kec['Kd_Kec']);
									$totalbiayakel += $biayaperkel($kec['Kd_Kec']);
									$totalUsulanDesaTerusan += $usulankelterima($kec['Kd_Kec']);
									$totalbiayadesaterus+=$biayakelterima($kec['Kd_Kec']);
									$totalUsulanDesaTolak += $usulanperkel($kec['Kd_Kec'])-$usulankelterima($kec['Kd_Kec']);
									$totalbiayadesatolak+=$biayaperkel($kec['Kd_Kec'])-$biayakelterima($kec['Kd_Kec']);
									$totalUsulanKecamatan += $usulankecamatan($kec['Kd_Kec']);
									$totalbiayaKecamatan += $biayakecamatan($kec['Kd_Kec']);
									$totalUsulanKecamatanTerusan += $usulankecamatanterima($kec['Kd_Kec']);
									$totalbiayakecterus+= $biayakecamatanterima($kec['Kd_Kec']);
									$totalUsulanKecamatanTolak += $usulankecamatan($kec['Kd_Kec'])-$usulankecamatanterima($kec['Kd_Kec']);
									$totalbiayakectolak+= $biayakecamatan($kec['Kd_Kec'])-$biayakecamatanterima($kec['Kd_Kec']);

									/*$totalUsulanPokir += $usulanpokir($kec['Kd_Kec']);
									$totalUsulanPokirTerusan += $usulanpokirterima($kec['Kd_Kec']);
									$totalUsulanPokirTolak += $usulanpokir($kec['Kd_Kec'])-$usulanpokirterima($kec['Kd_Kec']);*/
								?>
								<tr>
									<td><?=$no;$no++;?></td>
									<td align="left"style="font-weight:bold;"><?=$kec['Nm_Kec'];?></td>
									<td style="text-align:right"><?=$datakel($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=$usulanperkel($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=number_format($biayaperkel($kec['Kd_Kec']),"0", ",", ".") ;?></td> 
									<td style="text-align:right"><?=$usulankelterima($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=number_format($biayakelterima($kec['Kd_Kec']),"0", ",", ".") ;?></td> 									
									<td style="text-align:right"><?=$usulanperkel($kec['Kd_Kec'])-$usulankelterima($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=number_format($biayaperkel($kec['Kd_Kec'])-$biayakelterima($kec['Kd_Kec']),"0", ",", ".") ;?></td>
									
									
									<td style="text-align:right"><?=$usulankecamatan($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=number_format($biayakecamatan($kec['Kd_Kec']),"0", ",", ".");?></td>
									<td style="text-align:right"><?=$usulankecamatanterima($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=number_format($biayakecamatanterima($kec['Kd_Kec']),"0", ",", ".");?></td>
									<td style="text-align:right"><?=$usulankecamatan($kec['Kd_Kec'])-$usulankecamatanterima($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=number_format($biayakecamatan($kec['Kd_Kec'])-$biayakecamatanterima($kec['Kd_Kec']),"0", ",", ".");?></td>
									
									<!--<td style="text-align:right"><?=$usulanpokir($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=$usulanpokirterima($kec['Kd_Kec']);?></td>
									<td style="text-align:right"><?=$usulanpokir($kec['Kd_Kec'])-$usulanpokirterima($kec['Kd_Kec']);?></td>-->
								</tr>
								<?php } ?>
								<tr style="background:#eaeaea;">
									<td></td>
									<td align="left"style="font-weight:bold;">Total</td>
									<td style="text-align:right;"><?=$totalDesa;?></td>
									<td style="text-align:right"><?=$totalUsulanDesa;?></td>
									<td style="text-align:right"><?=number_format($totalbiayakel ,"0", ",", ".");?></td>
									<td style="text-align:right"><?=$totalUsulanDesaTerusan;?></td>
									<td style="text-align:right"><?=number_format($totalbiayadesaterus,"0", ",", ".");?></td>
									<td style="text-align:right"><?=$totalUsulanDesaTolak;?></td>
									<td style="text-align:right"><?=number_format($totalbiayadesatolak,"0", ",", ".");?></td>
									<td style="text-align:right"><?=$totalUsulanKecamatan;?></td>
									<td style="text-align:right"><?=number_format($totalbiayaKecamatan,"0", ",", ".");?></td>
									<td style="text-align:right"><?=$totalUsulanKecamatanTerusan;?></td>
									<td style="text-align:right"><?=number_format($totalbiayakecterus,"0", ",", ".");?></td>
									<td style="text-align:right"><?=$totalUsulanKecamatanTolak;?></td>
									<td style="text-align:right"><?=number_format($totalbiayakectolak,"0", ",", ".");?></td>
									<!--<td style="text-align:right"><?=$totalUsulanPokir;?></td>
									<td style="text-align:right"><?=$totalUsulanPokirTerusan;?></td>
									<td style="text-align:right"><?=$totalUsulanPokirTolak;?></td> -->
								</tr>
								
							</table>