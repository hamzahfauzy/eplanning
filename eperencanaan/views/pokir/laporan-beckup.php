<table class="table table-bordered data-table tabel-data">
            <thead>
              <tr>
                  <th>No</th>
                  <th>Kegiatan Prioritas </th>
                  <th>Prioritas Kota </th>
                  <th>Jumlah/Vol </th>
                  <th>Pagu(Rp)</th>
                  <th>SKPD Penanggung Jawab</th>
                  <th>Kode Pembangunan</th>
                  <!-- <th>Rincian Skor</th> -->
              </tr>
            </thead>
            <tbody class="table table-bordered">
            <?php
              $no = 0;
              $status = ['Belum Punya Status','Terima','Terima Dengan Perubahan','Ditolak'];
              // foreach ($data as $value):
              // $no++;
              ?>

              <tr>
                  <td><?php // $no ?></td>
                  <td><?php //$value->Nm_Permasalahan ?></td>
                  <td><?php //$value->Jenis_Usulan ?></td>
                  <td><?php //$value->Jumlah ?></td>
                  <td><?php //number_format($value->Harga_Total,0,'.','.') ?></td>
                  <td><?php //($value->Kd_Sub) ? $value->subUnit->kdSubUnit->Nm_Sub_Unit : '-' ?></td>
                  <td><?php //$value->Kd_Pem ?></td>
                  <!-- <td><?php if($isi = $value->Rincian_Skor) print_r(unserialize($value->Rincian_Skor))  ?></td> -->
              </tr>
              <?php endforeach;
      
            ?>
            </tbody>
          </table>