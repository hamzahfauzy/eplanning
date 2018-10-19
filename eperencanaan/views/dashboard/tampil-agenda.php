<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;

setlocale(LC_ALL, 'INDONESIA');
include"header.php";


?>
					
			
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper wrapper-white">
                            <div class="page-subtitle">
							
                                <h3>JADWAL PELAKSANAAN </h3>
                            </div>
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th style="text-align:center">No</th>
										<th style="text-align:center">AGENDA</th>
										<th style="text-align:center">WAKTU</th>
										<th style="text-align:center">KETERANGAN</th>
										
										
									</tr>
								</thead>
								</thead>
								<tbody>
								<?php 
								$no=1;
								foreach($data as $rows):
								?>
									<tr>
									
										<td><?=$no;?>  </td>
											<td>
												 <?=$rows['Agenda'];?> </td>
											
										<td align="Center"><?=$rows['Waktu'];?>  </td>
										<?php if ($rows['Keterangan']=="Selesai"){ ?>
											
										<td align="Center"><font style="color: green"><?=$rows['Keterangan'];?>   </font>
										<?Php }
											else
											{
												?>
											<td align="Center"><font style="color: red"><?=$rows['Keterangan'];?>   </font>
										
											<?php }
											if ($no==3) { ?>
													<br>
													<a href="../agenda/Jadwal Musrenbang Kecamatan.pdf" target="_blank">[Download Jadwal Musrenbang Kecamatan Revisi]</a>
											<?php } ?>
											
											</td>
											
									</tr>
										
											
								<?php $no++; endforeach; ?>
								
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