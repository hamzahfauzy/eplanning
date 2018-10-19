<?php
use common\models\TaRpjmdSasaran;
use yii\helpers\Html;
use emusrenbang\models\Referensi;
use yii\widgets\ActiveForm;
use common\models\RefRPJMD2;
use common\models\TaProgram;
use common\models\TaRpjmdProgramPrioritas;
?>

<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
<tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN II : BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;HASIL MUSRENBANG RKPD KABUPATEN ASAHAN<td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php //echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php //echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;__________________________________________________________________</td> </tr>

</table>
<br>
<br>


     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>SASARAN DAN PRIORITAS PEMBANGUNAN DAERAH RKPD <br>KABUPATEN ASAHAN <br> TAHUN <?= date('Y')+1 ?></h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
               <thead>
                    <tr>
                        <th style="vertical-align: middle;"><p class="text-center">No</p></th>
                        <th  style="vertical-align: middle;"><p class="text-center">Sasaran</p></th>
                        <th style="vertical-align: middle;"><p class="text-center">Prioritas Pembangunan Daerah </p></th>
						<th style="vertical-align: middle;"><p class="text-center">Program Prioritas Pembangunan Daerah </p></th>
                        
                      
                    </tr>
                    
					<tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
                                
                            </tr>
                        </thead>
                 <tbody>                      

    
                        <?php
						$no=0;
						$subprogram=TaRpjmdProgramPrioritas::find()
								->all();
                       // $subprogram = $unitsubs->taPrograms;
                        foreach ($subprogram as $program) :
						$no=$no+1;
		
										$GS=TaRpjmdSasaran::find()
											->where (['No_Misi'=>$program['No_Misi']])
											->andwhere (['No_Tujuan'=>$program['No_Tujuan']])
											->andwhere (['No_Sasaran'=>$program['No_Sasaran']])
											->orderBy(['No_Sasaran' => SORT_ASC])
											
											->one();
										$GD=RefRPJMD2::find()
											->where (['Kd_Prioritas_Pembangunan_Kota'=>$program['No_Prioritas']])
											->one();
											$PRO=TaProgram::find()
											->where (['Kd_Prog'=>$program['Kd_Prog']])
										//	->orderBy(['Kd_Prog' => SORT_ASC])
											->one();
										
								?> 
                       
                        <tr>
                         
                         <td style="font-size:11px;"> <?= $no; ?> </td>
						<td><?php echo  $GS['Sasaran'];?></td>
						 <td><?php echo $GD['Nm_Prioritas_Pembangunan_Kota'];?></td>
						  <td><?php echo $PRO['Ket_Prog'];?></td>
							   
						
                        <?php endforeach; ?>


                        </tbody>
            </table>
        </div>
    </div>