<?php 
use emusrenbang\models\TaBelanjaRincSubProv;
?>
<div class="row">
  <div class="col-md-12">
      <div class="box box-success">
          <div class="box-header with-border">
              <h3 class="box-title">LAPORAN PENGGUNAAN USULAN APBD PROVINSI</h3>
              <span class="label label-success pull-right"><i class="fa fa-book"></i></span>
          </div><!-- /.box-header -->
          <div class="box-body">
              <ul class="products-list product-list-in-box">
                 <li>
                  <table class="table table-bordered">
                  <tr>
                      <td style="font-size:12px;"><b>Penggunaan Pagu Untuk Kegiatan:</b>
					   <?= $xUnit->Nm_Sub_Unit;?></td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="vcenter text-center"><B>Program</td>
                      <td class="vcenter text-center"><B>Kegiatan</td>
					  <td><b>Volume</td>
                      <td class="vcenter text-center"><B>Pagu Indikatif</td>
                  </tr>
                  <?php 
				  $xTotal=0;
                      foreach ($dataKegiatan as $data): 
                      if ($data->getKegiatans()->count()<=0) {
                          continue;
                      }
					  $xTotal=$xTotal+$data->getBelanjaRincSubs()->sum('Total');
                  ?>

                  <tr>
                      <td style="font-size:12px;" > <B><?= $data->refProgram['Ket_Program'] ?></td>
                      <td></td>
					  <td></td>
                      <td style="font-size:12px;" align="right"> <b><?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></b></td>
                  </tr>


                  <?php $dataProgKeg = $data->kegiatans;
                        
						foreach ($dataProgKeg as $dataProgKegs) :
						
                   ?>

                  <tr>
                      <td></td>
                      <td style="font-size:12px;" > <B><?= $dataProgKegs['Ket_Kegiatan'] ?></td>
					  <td></td>
                      <td style="font-size:12px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                  </tr>
					<?php 
								$PosisiKegiatan = [
							'Kd_Urusan' =>  $dataProgKegs['Kd_Urusan'], 
							'Kd_Bidang' => $dataProgKegs['Kd_Bidang'],
							'Kd_Unit' => $dataProgKegs['Kd_Unit'],
							'Kd_Sub' => $dataProgKegs['Kd_Sub'],
							'Kd_Prog' => $dataProgKegs['Kd_Prog'],
							'Kd_Keg' => $dataProgKegs['Kd_Keg'],
							];
								$data_belanja1=TaBelanjaRincSubProv::find()
								->where($PosisiKegiatan)
								//->andwhere(['Kd_Rek_3'=>3])
								
								->all();
								foreach ($data_belanja1 as $xxB) :
								if (($xxB['Kd_Rek_3']=='2' && $xxB['Kd_Rek_4']=='24') ||$xxB['Kd_Rek_3']=='3')
								{
							 ?>
							
							<tr>
							<td style="font-size:11px;"></td>
                            <td style="font-size:11px;"> <i>
							<?php 
								
								
									echo $xxB['Keterangan'];
									
								
									

							 ?>
							
                            <td style="font-size:11px;" > <i>
							<?php 
								
								
									//echo number_format($xxB['Jml_Satuan'],0, ',', '.')." ". $xxB['Satuan123'];
									echo number_format($xxB['Nilai_1'],0, ',', '.')." ". $xxB['Sat_1'];
									if ($xxB['Nilai_2']!="" ||$xxB['Nilai_2']!=0)
									{
										echo " x ".number_format($xxB['Nilai_2'],0, ',', '.')." ". $xxB['Sat_2'];
									}
									if ($xxB['Nilai_3']!="" ||$xxB['Nilai_3']!=0)
									{
										echo " x ".number_format($xxB['Nilai_3'],0, ',', '.')." ". $xxB['Sat_3'];
									}
									

							?>
							</td>
                            <td></td>
                            

                        </tr>    
								<?php } ?>
                        <?php endforeach; ?>  
                  <?php endforeach;?>
                  <?php endforeach;?>

                  <tr>
                      <td><b>Total</td>
                      <td></td>
					  <td></td>
                      <!--<td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td> -->
					  
					  <td style="font-size:12px;" align="right" > <b> <?= number_format($xTotal,0, ',', '.') ?> </b></td>
                  </tr>
                  </table>
                  </li>        
              </ul>
          </div>
      </div><!-- /.box -->
  </div><!-- /.col -->
</div>