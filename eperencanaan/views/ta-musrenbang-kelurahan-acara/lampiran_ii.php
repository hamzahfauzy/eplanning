<?php
use yii\helpers\html;
setlocale(LC_ALL, 'INDONESIA');
?>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
 <tr >
<td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;LAMPIRAN II :&nbsp; BERITA ACARA KESEPAKATAN  </td> </tr>
<tr><td>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;HASIL MUSRENBANG DESA/KELURAHAN<td></tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;NOMOR &nbsp;&nbsp;&nbsp;: <?php echo ($model->Nomor_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;TANGGAL&nbsp;: <?php echo ($model->Tanggal_Berita_Acara);?></td> </tr>
<tr><td >&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;-------------------------------------------------- </td> </tr>

</table>

<br/>
      <h5 style="text-align: center; text-transform: uppercase;"><BR>DAFTAR PRIORITAS DESA/KELURAHAN MENURUT OPD</h5>
      <br/>
<table style ="width: 100%;text-align: justify;vertical-align: top;border-collapse: collapse;">
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Desa/Kelurahan&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&thinsp;:&nbsp;<?php echo $model->kdKel->Nm_Kel; ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kecamatan&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&thinsp;:&nbsp;<?php echo $model->kdKec->Nm_Kec; ?></td> </tr>
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kabupaten&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;ASAHAN
    <tr ><td style="border: 1px solid black;padding: 8px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tahun&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&thinsp;:&nbsp;<?= $Tahun+1; ?></td> </tr>

    
</table>



<table style="width: 150%;">
  <tr>
    <td style="text-align:center;">
      

</BR>
      <table style="border: 1px solid black; text-align: center; width: 100%;height:200%;border-collapse: collapse;">
        <tr>
          <td style="width: 50px;border: 1px solid black;">No</td>
          <td style="width: 100px;height: 50px;border: 1px solid black;">Bidang Pembangunan</td>
          <td style="width: 250px;height: 50px;border: 1px solid black;">Permasalahan</td>
          <td style="width: 250px;border: 1px solid black;">Usulan Kegiatan</td>
	<td style="width: 250px;border: 1px solid black;">Lokasi</td>
          <td style="width: 50px;border: 1px solid black;">Volume</td> 
          <td style="width: 120px;border: 1px solid black;">Perkiraan Anggaran (Rp.)</td>
	  <td style="width: 120px;border: 1px solid black;">Perangkat Daerah Penanggungjawab</td>
        </tr>
        <?php 
          //bila usulan nihil
          if ($data->count() == 0) {
            echo '<tr><td colspan="7" style="text-align: center;"><i><h2>NIHIL</h2></i></td></tr>';
          }

          $x = 0;
          $batas=25;
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
                  <b>Spesifikasi</b><br>
                  <?= $model->Def_Operasional ?>
                </td>
		<td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;">
		<?php if(empty($model->kdJalan->Nm_Jalan))
		{
			; 
		}
		else
		{
			echo $model->kdJalan->Nm_Jalan;//$rows->kdJalan->Nm_Jalan.", ".$rows->kelurahan->Nm_Kel.", ".$rows->lingkungan->Nm_Lingkungan;
		}
		?> 
		<br>
		<?php if(empty($model->kdLingkungan->Nm_Lingkungan))
		{;
		}
		else
		{
		echo $model->kdLingkungan->Nm_Lingkungan; 
		}
		?></td>
                <td style="width: 50px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Jumlah . ' ' . $model->kdSatuan->Uraian ?></td>
                <td style="width: 120px;border: 1px solid black; text-align: right;padding: 2px;"><?= Yii::$app->zultanggal->ZULgetcurrency($model->Harga_Total) ?></td>
				<td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?=@$model->subUnit->Nm_Sub_Unit;?></td>
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
	<td style="width: 250px;border: 1px solid black;">Lokasi</td>
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
		      <td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;">
			  <?php if(empty($model->kdJalan->Nm_Jalan))
		{
			; 
		}
		else
		{
			echo $model->kdJalan->Nm_Jalan;//$rows->kdJalan->Nm_Jalan.", ".$rows->kelurahan->Nm_Kel.", ".$rows->lingkungan->Nm_Lingkungan;
		}
		?> 
			  
			  
			  
		<br> <?= $model->kdLingkungan->Nm_Lingkungan ?></td>
                      <td style="width: 50px;border: 1px solid black; text-align: justify;padding: 2px;"><?= $model->Jumlah . ' ' . $model->kdSatuan->Uraian ?></td>
                      <td style="width: 120px;border: 1px solid black; text-align: right;padding: 2px;"><?= Yii::$app->zultanggal->ZULgetcurrency($model->Harga_Total) ?></td>
			<td style="width: 250px;border: 1px solid black; text-align: justify;padding: 2px;"><?=@$model->subUnit->Nm_Sub_Unit;?></td>

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
    </td>
  </tr>
</table>
