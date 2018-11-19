<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use eperencanaan\models\PantauKunjung;

setlocale(LC_ALL, 'INDONESIA');
include"header.php";


?>
					
			
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							
                                 <h3>TRANSAKSI KEGIATAN EPLANNING  	<a href="index.php?r=dashboard%2Fpantaukunjung">[Kembali] </a></h3>
                            </div>
							
								<?php 
								$Bulan=date("m-Y");
								
							
								
							$data1 = PantauKunjung::find()
										//->SELECT (['ip','username',"DATE_FORMAT(created_at,'%d-%m-%Y') as  created_at"])->distinct()  
										->Where(['DATE_FORMAT(created_at, "%m-%Y")'=>$Bulan])
										->orderBy(['created_at' => SORT_DESC])
										->all(); 
							
							?>
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<th style="text-align:center">Tanggal </th>
										<th style="text-align:center">Username</th>
										<th style="text-align:center">Transaksi</th>
										<th style="text-align:center">IP Address</th>
										
										
										
									</tr>
								</thead>
								</thead>
								<tbody>
								<?php 
								$no=1;
								
								foreach($data1 as $rows):
								$xTanggal=date("d F Y H:i:s",strtotime($rows['created_at']));
													 ?>
										
													 
												<tr>
													<td><?=$no;?></td>
												
												<td> <?=$xTanggal;?></td> 
												<td> <?=@$rows['username'];?></td> 
												<td> <?=@$rows['kegiatan'];?></td>
												<td> <font style="color: green"> <?=@$rows['ip'];?>  </font></td>
												</tr>
								<?php $no++; endforeach; ?>
							
							
																				
								</tbody>
							</table>
							
							
                        </div>
                    </div>
                </div>
				
