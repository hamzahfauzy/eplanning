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
							
                                <h3>PENGUNJUNG</h3>
                            </div>
							
								<?php 
								$Sekarang=date("d-m-Y");
								//$Kemaren=date("d-m-Y");
								$n=1;
								$PrevN = mktime(0, 0, 0, date("m"), date("d") - $n, date("Y"));
								$Kemaren=date("d-m-Y",$PrevN);
								//$Kemaren1= date("d-m-Y", strtotime('-1 day', $Sekarang));
								$Bulan=date("m-Y");
								 
								$Tahun=date("Y");
								
							$data1 = PantauKunjung::find()->SELECT (['ip','username',"DATE_FORMAT(created_at,'%d-%m-%Y') as  created_at"])->distinct()  
										->Where(['DATE_FORMAT(created_at, "%d-%m-%Y")'=>$Sekarang])
										->count(); 
							 $data2 = PantauKunjung::find()->SELECT (['ip','username',"DATE_FORMAT(created_at,'%d-%m-%Y') as  created_at"])->distinct()  
								->Where(['DATE_FORMAT(created_at, "%d-%m-%Y")'=>$Kemaren])		
								->count(); 
				
							 $data3 = PantauKunjung::find()->SELECT (['ip','username',"DATE_FORMAT(created_at,'%d-%m-%Y') as  created_at"])->distinct()  
								->Where(['DATE_FORMAT(created_at, "%m-%Y")'=>$Bulan])	
								->count(); 
							$data4 = PantauKunjung::find()->SELECT (['ip','username',"DATE_FORMAT(created_at,'%d-%m-%Y') as  created_at"])->distinct()  
							->Where(['DATE_FORMAT(created_at, "%Y")'=>$Tahun])		
							->count();
							$data5 = PantauKunjung::find()		
							->count();
							?>
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">Pengunjung Hari Ini <br> <a href="index.php?r=dashboard%2Fpantauharini"><?=$Sekarang;?> </a></th>
										<th style="text-align:center">Pengunjung Kemaren <br> <a href="index.php?r=dashboard%2Fpantaukemaren"><?=$Kemaren;?> </a></th>
										<th style="text-align:center">Pengunjung Bulan Ini <br> <a href="index.php?r=dashboard%2Fpantaubulani"><?=date("F");?></a></th>
										<th style="text-align:center">Total Pengunjung <br> <?=$Tahun;?></th>
										<th style="text-align:center">Total Transaksi <br> <?=$Tahun;?></th>
										
										
										
									</tr>
								</thead>
								</thead>
								<tbody>
								<!--<?php 
								$no=1;$w1[0]="tes";$w2[0]="tes";$cJum=0;
								//$Sekarang=date("d-m-Y");
								//Pengunjung Hari Ini
								//foreach($data1 as $rows):
								//	$cIP=@$rows1['ip'];
								//	$cUser=@$rows1['username'];
									//$cJum=$cJum+1;
								?>
									
										
											<?php
												
											/*
												$Sekarang="02 February 2018";
												//$Sekarang1=date("d F Y");
												$xTanggal=date("d F Y",strtotime($rows['created_at']));
												$xJam=date("H:i:s",strtotime($rows['created_at']));
												if ($xTanggal==$Sekarang ) 
												{ 
													$cJum=$cJum+1;
													$w1[$cJum]=$rows['ip'];
													$w2[$cJum]=$rows['username'];
													//$w3[$cJum]=$xTanggal;
													 */?>
													 <!--
												<tr>
													<td><?=$no;?></td>
												<td> <font style="color: red"> <?=@$rows['ip'];?>  </font></td>
												<td> <?=@$rows['created_at'];?></td> 
												<td> <?=@$rows['username'];?></td> 
												<!--<td> <?=@$xJam;?></td>
												</tr>-->
												
												<?php// } ?> 
												 
											
											
								<?php //$no++; endforeach; ?>
							
								<tr>
												
												<td align="center"> <?=number_format(@$data1);?></td>
												<td align="center"> <?=number_format(@$data2);?></td>
												<td align="center"> <?=number_format(@$data3);?></td>												
												<td align="center"> <?=number_format(@$data4);?></td>
												<td align="center"> <?=number_format(@$data5);?></td>
											
												</tr>
																				
								</tbody>
							</table>
							
							
                        </div>
                    </div>
                </div>
				
<?php
Modal::begin([
    'header' => '<h4>Lihat File</h4>',
    "size"=>"modal-default",
    'footer' => Html::button('Tutup',['class'=>'btn btn-primary pull-left','data-dismiss'=>"modal"]),
    "id"=>"lihatFileModal",
]);
echo "<div id='isi_modal'></div>";
Modal::end();
?>