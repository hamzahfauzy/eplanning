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
        foreach ($data_rincian as $rinci) :
          $Asal = $rinci->Asal;
          $uraian = '';
          $harga = 0;
          if ($Asal == '1') {
            $nomor=$rinci->Kd_Hspk_Ssh1."."
                    .$rinci->Kd_Hspk_Ssh2."."
                    .$rinci->Kd_Hspk_Ssh3."."
                    .$rinci->Kd_Hspk_Ssh4."."
                    .$rinci->Kd_Ssh5."."
                    .$rinci->Kd_Ssh6;

            $uraian=isset($rinci->kdSsh2) ? $rinci->kdSsh2->Nama_Barang : '-';
            $harga=isset($rinci->kdSsh2) ? $rinci->kdSsh2->Harga_Satuan : '-';
          }
          else if($Asal == '2'){
            $nomor=$rinci->Kd_Hspk_Ssh1."."
                    .$rinci->Kd_Hspk_Ssh2."."
                    .$rinci->Kd_Hspk_Ssh3."."
                    .$rinci->Kd_Hspk_Ssh4;

            $uraian=$rinci->kdHspk2->Uraian_Kegiatan;
            $harga=$rinci->kdHspk2->Harga;
          }
          else{
            $nomor=$rinci->Kd_Hspk_Ssh1."."
                    .$rinci->Kd_Hspk_Ssh2."."
                    .$rinci->Kd_Hspk_Ssh3."."
                    .$rinci->Kd_Hspk_Ssh4."."
                    .$rinci->Kd_Ssh5;
            if(isset($rinci->kdAsb2->Jenis_Pekerjaan)){
              $uraian=$rinci->kdAsb2->Jenis_Pekerjaan;
            }
            if(isset($rinci->kdAsb2->Harga)){
              $harga=$rinci->kdAsb2->Harga;
            }
            //$harga=$rinci->kdAsb2->Harga;
          }

          ?>
            <tr><!-- kategori -->
              <td> <?= $nomor ?> </td>
              <td class="kategori_pekerjaan"><?= isset($rinci->kategoriPekerjaan) ? $rinci->kategoriPekerjaan->Uraian : '-' ?></td>
              <td><?= $uraian ?></td>
              <td><?= $rinci->Koefisien ?></td>
              <td><?= isset($rinci->kdSatuan) ? $rinci->kdSatuan->Uraian : '-' ?></td>
              <td><?= $harga ?></td>
              <td></td>
            </tr>
          <?php
        endforeach;
      ?>
      <?php
      $total_semua=0;
      ?>
      <tr class="akhir"> <!-- toal akhir semua jumlah -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Nilai ASB</td>
        <td class="uang jumlah"><?= $total_semua ?></td>
      </tr>
      <!-- akhir kegiatan -->
    </tbody>
  </table>
</div>