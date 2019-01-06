<?php
use yii\helpers\html;
setlocale(LC_ALL, 'INDONESIA');
?>

<table style="width: 150%;">
  <tr>
    <td style="text-align:center;">
      <br/>
      <h3 style="text-align: center; text-transform: uppercase;"><BR>REKAPITULASI USULAN MUSRENBANG Desa/Kelurahan <?= $kelurahan; ?> <BR>TAHUN <?= $Tahun; ?></h3>
      <br/>
      <table style="border: 1px solid black; text-align: center; width: 100%;height:200%;border-collapse: collapse;">
        <tr>
          <td style="width: 50px;border: 1px solid black;">No</td>
          <td style="width: 100px;height: 50px;border: 1px solid black;">Bidang Pembangunan</td>
          <td style="width: 250px;height: 50px;border: 1px solid black;">Permasalahan</td>
          <td style="width: 250px;border: 1px solid black;">Usulan Kegiatan</td>
          <td style="width: 50px;border: 1px solid black;">Volume</td> 
          <td style="width: 120px;border: 1px solid black;">Perkiraan Anggaran (Rp.)</td>
	  <td style="width: 120px;border: 1px solid black;">OPD Penanggungjawab</td>
        </tr>
        <?php 
          //bila usulan nihil
          if ($data->count() == 0) {
            echo '<tr><td colspan="7" style="text-align: center;"><i><h2>NIHIL</h2></i></td></tr>';
          }

          $x = 0;
          $batas=27;
          $awal=0; 
          
          foreach ($data->limit($batas)->offset($awal)->all() as $model) :
            $x++;
            ?>
              <tr>
                <td style="width: 50px;height: 50px;border: 1px solid black;"><?= $x ?></td>
                <td style="width: 100px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->kdPem->Bidang_Pembangunan ?></td>
                <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Nm_Permasalahan ?></td>
                <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;">
                  <?= $model->Jenis_Usulan ?>
                  <br>
                  <p></p>
                  <b>Definisi Operasional</b><br>
                  <?= $model->Definisi_Operasional ?>
                </td>
                <td style="width: 50px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Jumlah . ' ' . $model->kdSatuan->Uraian ?></td>
                <td style="width: 120px;border: 1px solid black; text-align: right;padding: 2px;"><?= Yii::$app->zultanggal->ZULgetcurrency($model->Harga_Total) ?></td>
				<?php if (empty($model->subUnit->Nm_Sub_Unit)) {
					$ssUnit="-";
				} else
				{
					$ssUnit=$model->subUnit->Nm_Sub_Unit;
				}
				?>
				<td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?=$ssUnit;?></td>
              </tr>
            <?php
          endforeach;
        ?>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <?php
    $jlh_data = $data->count();
    $jlh_hal = ceil($jlh_data / $batas );
    for ($i=2; $i <= $jlh_hal; $i++) :
      ?>
        <tr>
          <td style="text-align:center;">
            <h3 style="text-align: center;">&nbsp;</h3>
            <br/>
            <table style="border: 1px solid black; text-align: center; width: 100%;height:200%;border-collapse: collapse;">
              <tr>
                <td style="width: 50px;border: 1px solid black;">No</td>
                <td style="width: 100px;height: 50px;border: 1px solid black;">Bidang Pembangunan</td>
                <td style="width: 250px;height: 50px;border: 1px solid black;">Permasalahan</td>
                <td style="width: 250px;border: 1px solid black;">Usulan Kegiatan</td>
                <td style="width: 50px;border: 1px solid black;">Volume</td> 
                <td style="width: 120px;border: 1px solid black;">Perkiraan Anggaran (Rp.)</td>
		<td style="width: 120px;border: 1px solid black;">OPD Penanggungjawab</td>
              </tr>
              <?php 
                $hal=$i;
                $awal=($hal-1)*$batas;
                
                foreach ($data->limit($batas)->offset($awal)->all() as $model) :
                  $x++;
                  ?>
                    <tr>
                      <td style="width: 50px;height: 50px;border: 1px solid black;"><?= $x ?></td>
                      <td style="width: 100px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->kdPem->Bidang_Pembangunan ?></td>
                      <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Nm_Permasalahan ?></td>
                      <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Jenis_Usulan ?></td>
                      <td style="width: 50px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Jumlah . ' ' . $model->kdSatuan->Uraian ?></td>
                      <td style="width: 120px;border: 1px solid black; text-align: right;padding: 2px;"><?= Yii::$app->zultanggal->ZULgetcurrency($model->Harga_Total) ?></td>
			<td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?=$model->subUnit->Nm_Sub_Unit;?></td>

                    </tr>
                  <?php
                endforeach;
              ?>
            </table>
          </td>
        </tr>
      <?php
    endfor;
  ?>
  <tr>
    <td>
      <table style="text-align: center;width: 100%">
        <tr>
          <td></td>
        </tr>
        <tr>
          <td colspan="2">Mengetahui</td>
          <td colspan="2"> </td>
        </tr>
        <tr>
          <td colspan="4" > </td>
        </tr>
        <tr>
          <td>Kepala Desa/Lurah</td>
          <td>Tim Pendamping</td>
          <td>Perwakilan Kepala Dusun/Lingkungan</td>
          <td>Perwakilan Masyarakat</td>
        </tr>
        <tr>
          <td style="height: 75px"></td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td>(.............................................)</td>
          <td>(.............................................)</td>
          <td>(.............................................)</td>
          <td>(.............................................)</td>
        </tr>
        <tr>
          <td>NIP : .............................................</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
