<div class="row">
  <div class="col-md-12">
      <div class="box box-success">
          <div class="box-header with-border">
              <h3 class="box-title">LAPORAN PENGGUNAAN USULAN APBN</h3>
              <span class="label label-success pull-right"><i class="fa fa-book"></i></span>
          </div><!-- /.box-header -->
          <div class="box-body">
              <ul class="products-list product-list-in-box">
                 <li>
                  <table class="table table-bordered">
                  <tr>
                      <td style="font-size:12px;"><b>Penggunaan Pagu Untuk Kegiatan: </b>
					  <?= $xUnit->Nm_Sub_Unit;?>
					  </td>
                      <td></td>
                      <td></td>
                  </tr>
                  <tr>
                      <td class="vcenter text-center">Program</td>
                      <td class="vcenter text-center">Kegiatan</td>
                      <td class="vcenter text-center">Pagu Indikatif</td>
                  </tr>
                  <?php 
                      foreach ($dataKegiatan as $data): 
                      if ($data->getKegiatans()->count()<=0) {
                          continue;
                      }
                  ?>

                  <tr>
                      <td style="font-size:12px;" > <?= $data->refProgram['Ket_Program'] ?></td>
                      <td></td>
                      <td style="font-size:12px;" align="right"> <?= number_format($data->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                  </tr>


                  <?php $dataProgKeg = $data->kegiatans;
                        foreach ($dataProgKeg as $dataProgKegs) :
                   ?>

                  <tr>
                      <td></td>
                      <td style="font-size:12px;" > <?= $dataProgKegs['Ket_Kegiatan'] ?></td>
                      <td style="font-size:12px;" align="right" > <?= number_format($dataProgKegs->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                  </tr>

                  <?php endforeach;?>
                  <?php endforeach;?>

                  <tr>
                      <td>Total</td>
                      <td></td>
                      <td style="font-size:12px;" align="right"> <?= number_format($subunit->getBelanjaRincSubs()->sum('Total'),0, ',', '.') ?></td>
                  </tr>
                  </table>
                  </li>        
              </ul>
          </div>
      </div><!-- /.box -->
  </div><!-- /.col -->
</div>