<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\RefDapil;
use common\models\RefKomisiDprd;
use eperencanaan\models\RefDewan;
use common\models\RefFraksiDprd;
use common\models\TaUserDapil;
include"header.php";
?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
                                <h3>Informasi Usulan Pokir <b>( <?=($dewan) ?> ) </b></h3>
                            </div>
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<th style="text-align:center">Status</th>
										<th style="text-align:center">Permasalahan</th>
										<th style="text-align:center">Usulan</th>
										<th style="text-align:center">Lokasi</th>
										<th style="text-align:center">Kecamatan</th>
										<th style="text-align:center">Bidang Pembangunan</th>
										<th style="text-align:center">Prioritas Pembangunan Daerah</th>
										<th style="text-align:center">OPD Penanggung Jawab</th>
										<th style="text-align:center">Jumlah/Vol</th>
										<th style="text-align:center">Perk. Biaya (Rp)</th>
										<th style="text-align:center">Daerah Pemilihan</th>
										<th style="text-align:center">Fraksi</th>
										<th style="text-align:center">Keterangan</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;
								foreach($data as $rows): 
										if($rows['Status_Penerimaan_Skpd'] == '1')// && ($rows['Kd_Asal_Usulan] == '5' or $rows['Kd_Asal_Usulan] == '6' or $rows['Kd_Asal_Usulan] == '7' or $rows['Kd_Asal_Usulan] == '8'))
											$status = "Disetujui";
										else if($rows['Status_Penerimaan_Skpd'] == '2')
											$status = "Disetujui dengan revisi";
										else if($rows['Status_Penerimaan_Skpd'] == '3')
											$status = "Ditolak";
										else
											$status = "Belum Dibahas";

								?>
								<?php /*
											$data1=TaUserDapil::find()
											 ->where (['Kd_User'=>$rows['Kd_User']])
											 ->andWhere(['Tahun'=>date('Y')])
											 ->one(); 
											
											 $data2=RefDewan::find()
											->where (['Kd_Dewan'=>$data1['Kd_Dewan']])
											 ->andWhere(['Tahun'=>date('Y')])
											 ->one();
											 $data3=RefFraksiDprd::find()
											->where (['Kd_Fraksi'=>$data1['Kd_Fraksi']])
											 ->andWhere(['Tahun'=>date('Y')])
											 ->one();
											  $data4=RefKomisiDprd::find()
											->where (['Kd_Komisi'=>$data1['Kd_Komisi']])
											 ->andWhere(['Tahun'=>date('Y')])
											 ->one();
											 $data5=RefDapil::find()
											->where (['Kd_Dapil'=>$data1['Kd_Dapil']])
											 ->andWhere(['Tahun'=>date('Y')])
											 ->one();
									 */?> 
									<tr>
										<td><?=$no;?></td>
										<td align="center"><?=$status;?>
										<br>
										<b>
										<?=$rows['id'];?>
										</b>
										</td>
										<td><?=$rows['Nm_Permasalahan'];?></td>
										<td><?=$rows['Jenis_Usulan'];?></td>
										<td><?=$rows['Detail_Lokasi'];?></td>
										<td><?=$nama_kec($rows['Kd_Kec']);?></td>
										<td><?=$bidpem($rows['Kd_Pem']);?></td>
										<td><?=$rpjmd($rows['Kd_Prioritas_Pembangunan_Daerah']);?></td>
										<td><?=$rows->refSubUnit->Nm_Sub_Unit;?></td>
										<td align="center"><?=number_format($rows['Jumlah']);?>
										<?=$satuan($rows['Kd_Satuan']);?></td>
										<td align="right"><?=number_format($rows['Harga_Total']);?></td>
										<td>
											<?php //echo $rows['Kd_User']; ?>
											<?=$dapil($rows['Kd_User']);?>
											<?php //echo $data4['Nm_Komisi'] . " " . $data4['Keterangan'] ?>
										</td>
										<td>
											<?php echo $fraksi($rows['Kd_User']);?>
											<?php //echo $data2['Nm_Dewan']; ?>
											
										</td>
										<td><?=$rows['Alasan_Skpd'];?></td>
									</tr>
								<?php $no++; endforeach; ?>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
				<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
				<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
				<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
				<script>
					$('#example').DataTable();
				</script>
                <?php include"footer.php"; ?>