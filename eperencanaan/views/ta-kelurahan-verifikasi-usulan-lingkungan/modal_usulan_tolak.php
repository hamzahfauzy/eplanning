<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Form Usulan Ditolak</h4>
    </div>
    <div class="modal-body">
      <div>
        <form class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-4 control-label">Nama Permasalahan</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= $usulan->Nm_Permasalahan ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Jenis usulan</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= $usulan->Jenis_Usulan ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Bidang Pembangunan</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= $usulan->kdPem->Bidang_Pembangunan ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Jumlah</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= ($usulan->Jumlah.' '.$usulan->kdSatuan->Uraian) ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Harga</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= number_format($usulan->Harga_Total, 2, ',', '.') ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Bidang Pembangunan</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= $usulan->kdPem->Bidang_Pembangunan ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Jalan</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= $usulan->kdJalan->Nm_Jalan ?></p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Detail Lokasi</label>
            <div class="col-sm-8">
              <p class="form-control-static"><?= $usulan->Detail_Lokasi ?></p>
            </div>
          </div>
        </form>
      </div>
      <div>
        <form class="form-horizontal" id="form-tolak">
          <input type="hidden" id="kd_usulan_diterima" name="Kd_Ta_Forum_Lingkungan" value="<?= $Kd_Ta_Forum_Lingkungan ?>">
          <div class="form-group">
            <label class="col-sm-4 control-label">Prioritas Pembangunan</label>
            <div class="col-sm-8">
              <select class="form-control" name="Kd_Prioritas_Pembangunan_Daerah">
                <?php
                  foreach ($rpjmd as $key => $val_rpjmd) :
                    $Kd_Prioritas_Pembangunan_Kota = $val_rpjmd['Kd_Prioritas_Pembangunan_Kota'];
                    $Nm_Prioritas_Pembangunan_Kota = $val_rpjmd['Nm_Prioritas_Pembangunan_Kota'];
                    ?>
                      <option value="<?= $Kd_Prioritas_Pembangunan_Kota ?>"><?= ucfirst($Nm_Prioritas_Pembangunan_Kota) ?></option>
                    <?php
                  endforeach;
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Keterangan</label>
            <div class="col-sm-8">
              <textarea id="keterangan-ditolak" class="form-control" name="Keterangan" rows="3"></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      <button type="button" class="btn btn-primary" id="btn-simpan-tolak">Simpan</button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#btn-simpan-tolak").click(function(){
    var keterangan = $("#form-tolak textarea").val();

    if (keterangan == '') {
      alert('Keterangan Tidak Boleh Kosong!');
    }
    else{
      $(this).attr("disabled", true);
      $.ajax({ 
        type: "GET",
        url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-tolak-usulan',
        data:$('#form-tolak').serialize(),
        success: function(isi){
          alert(isi);
          get_usulan(); 
          load_jumlah();
          $('#modal_tolak').modal('hide');
        },
        error: function(){
          alert("failure");
        }
      });
    }
  });
</script>