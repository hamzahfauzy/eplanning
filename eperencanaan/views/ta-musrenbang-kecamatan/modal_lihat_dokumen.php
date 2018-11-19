<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Dokumen Usulan</h4>
    </div>
    <div class="modal-body">
      <table class="table table-bordered data-table">
        <tr>
          <th>Nama File</th>
          <th>Tipe File</th>
        </tr>
      <?php
        foreach ($data_dokumen as $key => $value) {
          //$value->kdPem->Bidang_Pembangunan
          $nama_file = $value->kdMedia->Nm_Media;
          $tipe_file = $value['Jenis_Dokumen'];

          $dir = @eperencanaan."/web";

          echo "
            <tr>
              <td>$nama_file</td>
              <td>$tipe_file</td>
              <td>
                <a href='data/$nama_file' target='_blank' class='btn btn-primary'>Download</a>
              </td>
            </tr>
          ";
        }
      ?>
      </table>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
    </div>
  </div>
</div>
