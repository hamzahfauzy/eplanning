<?php $this->registerJsFile(
    '@web/js/sistem/jquery.number.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>

<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Riwayat Perubahan Usulan</h4>


    </div>
    <div class="modal-body">
      <table class="table table-bordered data-table">
          
        <tr>
          <th>Tanggal</th>
          <th>Permasalahan</th>
          <th>Detail Lokasi</th>
          <th>Koordinat</th>
          <th>Jumlah</th> 
          <th>Harga Satuan</th>
          <th>Harga Total</th>
          <th>Keterangan</th>
        </tr>
      <?php
        foreach ($data_riwayat as $key => $value) {

          //$value->kdPem->Bidang_Pembangunan
          //$nama_file = $value->kdMedia->Nm_Media;
          $lokasi = $value['Detail_Lokasi'];
          $latitude = $value['Latitute'];
          $longitude = $value['Longitude'];
          $nama_permasalahan = $value['Nm_Permasalahan'];
          $jumlah = $value['Jumlah'];
          $harga_satuan =  $value['Harga_Satuan']; 
          $harga_total = $value['Harga_Total'];
          $keterangan = $value['Keterangan'];
          $harga_satuan = number_format($harga_satuan, 2, ',' , '.');
          $harga_total = number_format($harga_total, 2, ',', '.');


          echo "
            <tr>
              <td> ".Yii::$app->formatter->asDateTime($value["Tanggal"], 'dd MM yyyy, H:i:s')."
                              WIB
              <td>$nama_permasalahan</td>
              <td>$lokasi </td>
              <td>Lat : $latitude <br>
                  long : $longitude </td>
              <td>$jumlah</td>
              <td>$harga_satuan</td>
              <td>$harga_total</td>
              <td>$keterangan</td>

            </tr>
          "
          ;
         }
       ?> 
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
    </div>
  </div>
</div>
