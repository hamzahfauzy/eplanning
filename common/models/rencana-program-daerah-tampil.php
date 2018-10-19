<?PHP
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

?>
 <?= Html::a('Cetak', ['/laporan-rkpd/cetak-lampiran3'], ['class'=>'btn btn-bg btn-primary', 'target'=>'_blank']) ?>
    <div class="col-md-1"></div><div class="col-md-10" align="center" style="padding-bottom:10px"><h3>PROGRAM DAN KEGIATAN PERANGKAT DAERAH <br>KABUPATEN ASAHAN <br> TAHUN <?= date('Y')+1 ?></h3></div><div class="col-md-1"></div>
        <div class="col-xs-12 table-responsive">
       
		  <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">No</p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Urusan/Bidang Urusan Pemerintahan Daerah Dan Program/ Kegiatan </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Prioritas Daerah </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Sasaran Daerah </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Lokasi </p></th>
                        <th colspan="6" style="vertical-align: middle;"><p class="text-center">Indikator Kinerja </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Pagu Indikatif </p></th>
                        <th rowspan="3" style="vertical-align: middle;"><p class="text-center">Prakiraan Maju </p></th>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Keterangan </p></th>
                    </tr>
                    <tr>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Hasil Program </p></th>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Keluaran Kegiatan </p></th>
                        <th colspan="2" style="vertical-align: middle;"><p class="text-center">Hasil Kegiatan </p></th>
                        <th><p class="text-center">OPD </p></th>
                        <th><p class="text-center">Jenis Keg </p></th>
                    </tr>
					<tr>
                        <th><p class="text-center">Tolok Ukur </p></th>
                        <th><p class="text-center">Target </p></th>
                        <th><p class="text-center">Tolok Ukur </p></th>
                        <th><p class="text-center">Target </p></th>
                        <th><p class="text-center">Tolok Ukur </p></th>
                        <th><p class="text-center">Target </p></th>
                        <th><p class="text-center">1/2/3 </p></th>
                        <th><p class="text-center">1/2/3 </p></th>
                    
                    </tr>
					<tr>
                                <th class="text-center">(1)</th>
                                <th class="text-center">(2)</th>
                                <th class="text-center">(3)</th>
                                <th class="text-center">(4)</th>
                                <th class="text-center">(5)</th>
                                <th class="text-center">(6)</th>
                                <th class="text-center">(7)</th>
                                <th class="text-center">(8)</th>
                                <th class="text-center">(9)</th>
                                <th class="text-center">(10)</th>
								<th class="text-center">(11)</th>
								<th class="text-center">(12)</th>
								<th class="text-center">(13)</th>
								<th class="text-center">(14)</th>
								<th class="text-center">(15)</th>
                            </tr>
                </thead>
                <tbody>
				
                <?php foreach ($TaSubUnit as $value1):
                    ?>  
                    <tr>
                        <td><p style="font-size:11px;"><b><?= $value1->Kd_Urusan ?></p></td>
                        <td><p style="font-size:11px;"><b><?= $value1->urusan->Nm_Urusan ?></p></td>
                        <?php for($x=0;$x<13;$x++):?>
                            <td></td>
                        <?php endfor; ?>
                    </tr>
                    <tr>
                        <td><p style="font-size:11px;"><b><?= $value1->Kd_Urusan.".".$value1->Kd_Bidang ?></p></td>
                        <td><p style="font-size:11px;"><b><?= $value1->kdBidang->Nm_Bidang ?></p></td>
						
                        <?php for($x=0;$x<9;$x++):?>
                            <td></td>
                        <?php endfor; ?>
						<?php
$xxTot=0;$xxTot1=0;						
						foreach ($value1->taPrograms as $value21):
							
							foreach ($value21->taKegiatans as $value31): 
								$xxTot=$xxTot+$value31->pagu->pagu;
								$xxTot1=$xxTot1+$value31->Pagu_Anggaran_Nt1;
							endforeach;
						endforeach;
						
							?>
							 <td align="right"><p style="font-size:11px;"><b><?= number_format($xxTot,0,'.','.') ; ?></p></td>
							 <td align="right"><p style="font-size:11px;"><b><?= number_format($xxTot1,0,'.','.') ; ?></p></td>							
							
                    </tr>
					
                    <?php 
					
					foreach ($value1->taPrograms as $value2): 
					
					?>
                        <tr>
                            <td><p style="font-size:11px;"><b><?= $value1->Kd_Urusan.".".$value1->Kd_Bidang.".".$value2->Kd_Prog ?></p></td>
                            <td ><p style="font-size:11px;"><b><?= $value2->Ket_Prog ?></p></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<?php 
							$xTot=0;$xTot1=0;
							foreach ($value2->taKegiatans as $value3): 
								$xTot=$xTot+$value3->pagu->pagu;
								$xTot1=$xTot1+$value3->Pagu_Anggaran_Nt1;
							endforeach;
							?>
							
							 <td align="right"><p style="font-size:11px;"><b><?= number_format($xTot,0,'.','.') ; ?></p></td>
							 <td align="right"><p style="font-size:11px;"><b><?= number_format($xTot1,0,'.','.') ; ?></p></td>
							 <td><p style="font-size:11px;"><b><?= $value1->namaSub->Nm_Sub_Unit ?></p></td>
                            <!--<?php for($x=0;$x<13;$x++):?><td></td><?php endfor; ?> -->
                        </tr>
                        <?php foreach ($value2->taKegiatans as $value3): ?>
                            <tr>
                                <td><p style="font-size:11px;"><?=  $value1->Kd_Urusan.".".$value1->Kd_Bidang.".".$value2->Kd_Prog.".".$value3->Kd_Keg   ?></p></td>
                                <td><p style="font-size:11px;"><?= $value3->Ket_Kegiatan ?></p></td>
                                <td></td>
                                <td></td>
                                <td><?= $value3->Lokasi ?></td>
                                <?php foreach ($value3->taIndikators as $value4): ?>
                                    <?php if($value4->Kd_Indikator!=7): ?>
                                        <td><p style="font-size:11px;"><?= $value4->Tolak_Ukur ?></p></td>
                                        <td><p style="font-size:11px;"><?= number_format($value4->Target_Angka,0,'.','.') ?> <?= $value4->Target_Uraian ?></td></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td align="right"><p style="font-size:11px;"><?= number_format($value3->pagu->pagu,0,'.','.') ?></p></td>
                                <td align="right"><p style="font-size:11px;"><?= number_format($value3->Pagu_Anggaran_Nt1,0,'.','.') ?></p></td>
								
                               <td><p style="font-size:11px;"><b><?= $value1->namaSub->Nm_Sub_Unit ?></p></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>