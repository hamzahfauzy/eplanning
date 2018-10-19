<?php
use yii\helpers\Url;
?>
<div class="tabel-wrap">
  <table class="tabel-hasil">
    <thead>
      <tr>
        <th>NOMOR</th>
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
        <td><b><?= $model->kdHspk1->Kd_Hspk1.'.'.$model->Kd_Hspk2.'.'.$model->Kd_Hspk3.'.'.$model->Kd_Hspk4 ?></b></td>
        <td class="uraian_kegiatan"><?= $model->Uraian_Kegiatan ?></td>
        <td></td>
        <td><?= $model->kdSatuan->Uraian ?></td>
        <td></td>
        <td></td>
      </tr>
      <tr><!-- kategori -->
        <td></td>
        <td class="kategori_pekerjaan">Upah:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php
        $total_semua=0;
        $total_kategori_1=0;
        $ssh = $model->getTaSshHspks()->where(['Kategori'=>'1'])->all();
        foreach ($ssh as $key => $value) :
          $nomor=$value->Kd_Ssh1."."
                .$value->Kd_Ssh2."."
                .$value->Kd_Ssh3."."
                .$value->Kd_Ssh4."."
                .$value->Kd_Ssh5."."
                .$value->Kd_Ssh6;
          $total_kategori_1+=$value->Harga;
          ?>
            <tr><!-- tambah ssh -->
              <td><?= $nomor ?></td>
              <td><?= $value->kdSsh1->Nama_Barang ?></td>
              <td class="uang" style="text-align:rigth;"><?= $value->Koefisien ?></td>
              <td><?= $value->kdSatuan->Uraian ?></td>
              <td class="uang" style="text-align:rigth;"><?= number_format($value->Harga_Satuan,2,',','.') ?></td>
              <td class="uang" style="text-align:rigth;"><?= number_format($value->Harga,2,',','.') ?></td>
            </tr>
          <?php
        endforeach;
        $total_semua+=$total_kategori_1;
      ?>
      <tr><!-- jumlah ssh -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Jumlah</td>
        <td class="uang jumlah" style="text-align:rigth;"><?= number_format($total_kategori_1,2,',','.') ?></td>
      </tr>
      <tr><!-- kategori -->
        <td></td>
        <td class="kategori_pekerjaan">Bahan/Material:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php
        $total_kategori_2=0;
        $ssh = $model->getTaSshHspks()->where(['Kategori'=>'2'])->all();
        foreach ($ssh as $key => $value) :
          $nomor=$value->Kd_Ssh1."."
                .$value->Kd_Ssh2."."
                .$value->Kd_Ssh3."."
                .$value->Kd_Ssh4."."
                .$value->Kd_Ssh5."."
                .$value->Kd_Ssh6;
          $total_kategori_2+=$value->Harga;
          ?>
            <tr><!-- tambah ssh -->
              <td><?= $nomor ?></td>
              <td><?= $value->kdSsh1->Nama_Barang ?></td>
              <td class="uang" style="text-align:rigth;"><?= $value->Koefisien ?></td>
              <td><?= $value->kdSatuan->Uraian ?></td>
              <td class="uang" style="text-align:rigth;"><?= number_format($value->Harga_Satuan,2,',','.') ?></td>
              <td class="uang" style="text-align:rigth;"><?= number_format($value->Harga,2,',','.') ?></td>
            </tr>
          <?php
        endforeach;
        $total_semua+=$total_kategori_2;
      ?>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Jumlah</td>
        <td class="uang jumlah" style="text-align:rigth;"><?= number_format($total_kategori_2,2,',','.') ?></td>
      </tr>
      <tr><!-- kategori -->
        <td></td>
        <td class="kategori_pekerjaan">Sewa Peralatan:</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php
        $total_kategori_3=0;
        $ssh = $model->getTaSshHspks()->where(['Kategori'=>'3'])->all();
        foreach ($ssh as $key => $value) :
          $nomor=$value->Kd_Ssh1."."
                .$value->Kd_Ssh2."."
                .$value->Kd_Ssh3."."
                .$value->Kd_Ssh4."."
                .$value->Kd_Ssh5."."
                .$value->Kd_Ssh6;
          $total_kategori_3+=$value->Harga;
          ?>
            <tr><!-- tambah ssh -->
              <td><?= $nomor ?></td>
              <td><?= $value->kdSsh1->Nama_Barang ?></td>
              <td class="uang" style="text-align:rigth;"><?= $value->Koefisien ?></td>
              <td><?= $value->kdSatuan->Uraian ?></td>
              <td class="uang" style="text-align:rigth;"><?= number_format($value->Harga_Satuan,2,',','.') ?></td>
              <td class="uang" style="text-align:rigth;"><?= number_format($value->Harga,2,',','.') ?></td>
            </tr>
          <?php
        endforeach;
        $total_semua+=$total_kategori_3;
      ?>
      <tr><!-- jumlah ssh -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Jumlah</td>
        <td class="uang jumlah" style="text-align:rigth;"><?= number_format($total_kategori_3,2,',','.') ?></td>
      </tr>
      <tr class="akhir"> <!-- toal akhir semua jumlah -->
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td class="text-right text-bold">Nilai HSPK</td>
        <td class="uang jumlah" style="text-align:rigth;"><?= number_format($total_semua,2,',','.') ?></td>
      </tr>
      <!-- akhir kegiatan -->
    </tbody>
  </table>
</div>
