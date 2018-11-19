<?php
use yii\helpers\Url;
?>
<div class="tabel-wrap">
  <table class="tabel-hasil">
    <thead>
      <tr>
        <th>NOMOR</th>
        <th>KATEGORI PEKERJAAN</th>
        <th>URAIAN KEGIATAN</th>
        <th>KOEF.</th>
        <th>SAT</th>
        <th>HARGA SATUAN</th>
        <th>HARGA</th>
      </tr>
    </thead>
    <tbody>
      <!-- mulai kegiatan -->
      <tr><!-- judul kegiatan -->
        <td><b><?= $model->kdAsb1->Kd_Asb1.'.'.$model->Kd_Asb2.'.'.$model->Kd_Asb3.'.'.$model->Kd_Asb4 ?></b></td>
        <td class="kategori_pekerjaan"><?= $model->Jenis_Pekerjaan ?></td>
        <td></td>
        <td></td>
        <td>Titik</td>
        <td></td>
        <td></td>
      </tr>
      <?php
        $data_rincian = $model->getTaHspkAsbs()->all();
        $Total = 0;
        foreach ($data_rincian as $rinci) :
          $Asal = $rinci->Asal;

          $nomor=$rinci->Kd_Hspk_Ssh1."."
                  .$rinci->Kd_Hspk_Ssh2."."
                  .$rinci->Kd_Hspk_Ssh3."."
                  .$rinci->Kd_Hspk_Ssh4
                  .(($rinci->Kd_Ssh5) ? ".".$rinci->Kd_Ssh5 : "")
                  .(($rinci->Kd_Ssh6) ? ".".$rinci->Kd_Ssh6 : "");

          $uraian = isset($rinci->kdSsh2) ? $rinci->kdSsh2->Nama_Barang : '-';
          if($Asal == '2') {
              $uraian= isset($rinci->kdHspk2) ? $rinci->kdHspk2->Uraian_Kegiatan : '-';
          }
          else if ($Asal == '3'){
              $uraian = isset($rinci->kdAsb2) ? $rinci->kdAsb2->Jenis_Pekerjaan : '-';
          }

          $harga = $rinci->Jumlah_Harga;
          $Total += $harga;
            //$harga=$rinci->kdAsb2->Harga;

          ?>
            <tr><!-- kategori -->
              <td> <?= $nomor ?> </td>
              <td class="kategori_pekerjaan"><?= isset($rinci->kategoriPekerjaan) ? $rinci->kategoriPekerjaan->Uraian : '-' ?></td>
              <td><?= $uraian ?></td>
              <td style="text-align:right;"><?= $rinci->Koefisien ?></td>
              <td><?= isset($rinci->kdSatuan) ? $rinci->kdSatuan->Uraian : '-' ?></td>
              <td style="text-align:right;"><?= number_format($rinci->Harga_Satuan,2,',','.') ?></td>
              <td style="text-align:right;"><?= number_format($harga,2,',','.') ?></td>
            </tr>
          <?php
        endforeach;
      ?>
      <tr class="akhir"> <!-- toal akhir semua jumlah -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Nilai ASB</td>
        <td class="uang jumlah" style="text-align:right;"><?= number_format($Total,2,',','.') ?></td>
      </tr>
      <!-- akhir kegiatan -->
    </tbody>
  </table>
</div>