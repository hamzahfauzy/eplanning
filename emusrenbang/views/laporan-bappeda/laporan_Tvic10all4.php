<?php
use eperencanaan\models\TaMusrenbang;
?>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
<tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN IV : BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;HASIL MUSRENBANG RKPD KABUPATEN ASAHAN<td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php //echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php //echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;__________________________________________________________________</td> </tr>

</table>
<br>
<br>


     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>PROGRAM DAN KEGIATAN YANG BELUM DIAKOMODIR DALAM RANCANGAN RKPD <br>KABUPATEN ASAHAN <br> TAHUN <?= date('Y')+1 ?></h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
               <thead>
                    <tr>
                        <th style="vertical-align: middle;"><p class="text-center">No</p></th>
                        <th  style="vertical-align: middle;"><p class="text-center">Permasalahan</p></th>
                        <th style="vertical-align: middle;"><p class="text-center">Judul Kegiatan </p></th>
                        <th  style="vertical-align: middle;"><p class="text-center">Lokasi </p></th>
						 <th  style="vertical-align: middle;"><p class="text-center">Alasan </p></th>
                      
                    </tr>
                    
					<tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
								<th class="text-center">(4)</th>
                                
                            </tr>
                        </thead>
                <tbody>                      

    
                        <?php
						$no=0;
						$taMus=TaMusrenbang::find()
							->Where(['or',
								['Status_Penerimaan_Skpd' => '1'],
								['Status_Penerimaan_Skpd' => '2'],
								])
							->andwhere 	(['or',
								['Status_Penerimaan_Kota' => '1'],
								['Status_Penerimaan_Kota' => '2'],
								])
							->orderBy(['Kd_Asal_Usulan' => SORT_DESC])
							->all();
                       // $subprogram = $unitsubs->taPrograms;
                        foreach ($taMus as $kegiatan) :
						$no=$no+1;
		
										
								?> 
                       
                        <tr>
                         
                         <td style="font-size:11px;"> <?= $no; ?> </td>
						<td><?php echo  $kegiatan['Nm_Permasalahan'];?></td>
						 <td><?php echo $kegiatan['Jenis_Usulan'];?></td>
							<td><?php echo $kegiatan['Detail_Lokasi'];?></td> 
							
<td><?php echo $kegiatan['Alasan_Kota'];?></td>							
						
                        <?php endforeach; ?>


                        </tbody>
            </table>
        </div>
    </div>