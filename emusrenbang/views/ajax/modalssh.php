<?php
use app\models\RefStandardHarga3;
$js="$('[id^=\"ssh3_\"]').click(function(){
	v=$('[id^=\"ssh3_\"]').val();
	s=v.split('_');
	$('#Ket').val(s[1]);
    $('#Nilai_Rp').val(s[0]);
	$('#Nilai_Rp_1').val(currency(s[0]));
	// $('#Sat_1').val(s[2]);
	$('#Sat_1 option[value='+s[2]+']').prop('selected', true);
	$('#Satuan123').val(s[2]);
	$('[id^=\"responsive-\"]').modal('hide');
});


$('#Total_1').val(currency( $('#Total').val() ));
$('#Nilai_Rp_1').val( currency( $('#Nilai_Rp').val() ) );

Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
//UIExtendedModals.init('index.php?r=ajax/modaltest&id=test');
TableManaged.init();
";
$this->registerJs($js, 4, 'My');
?>
							<table class="table table-striped table-bordered table-hover" id="sample_2">
							<thead>
							<tr>
								<th>
									 Kelompok
								</th>
								<th>
									 Rincian
								</th>
								<th>
									 Uraian
								</th>
								<th>
									Harga
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$Tahun=date('Y');
    						$model3=RefStandardHarga3::find()
    							->select('Ref_Standard_Harga_1.Uraian as Kelompok, Ref_Standard_Harga_2.Uraian as Rincian, 
    								Ref_Standard_Harga_3.*')
    							->leftJoin('Ref_Standard_Harga_1', 'Ref_Standard_Harga_1.Kd_1=Ref_Standard_Harga_3.Kd_1')
    							->leftJoin('Ref_Standard_Harga_2', 'Ref_Standard_Harga_2.Kd_1=Ref_Standard_Harga_3.Kd_1 
    								and Ref_Standard_Harga_2.Kd_2=Ref_Standard_Harga_3.Kd_2')
    							->where(['Ref_Standard_Harga_3.Tahun'=>$Tahun])->all();
    						
    						foreach($model3 as $d3){
    						?>
							<tr class="odd gradeX">
								<td>
									<?php
									echo $d3['Kd_1']." : ".$d3['Kelompok'];
									?>
								</td>
								<td>
									 <?php
									echo $d3['Kd_2']." : ".$d3['Rincian'];
									?>
								</td>
								<td>
									<?php
									echo $d3['Kd_3']." : ".$d3['Uraian']." ".$d3['Keterangan'];
									?>
								</td>
								<td>
									<?php
									echo "<button class='btn btn-primary' id='ssh3_".$d3['Kd_1']."_".$d3['Kd_2']."_".$d3['Kd_3']
    							."' value='".$d3['Harga']."_".$d3['Uraian']." ".$d3['Keterangan']."_".$d3['Satuan']."'>"
    							.number_format($d3['Harga'])."</button>";
									?>
								</td>
							</tr>
							<?php
							}
							?>
							</tbody>
							</table>
						
