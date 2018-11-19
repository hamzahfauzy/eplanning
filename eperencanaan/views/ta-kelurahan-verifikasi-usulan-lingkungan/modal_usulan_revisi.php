<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Form Usulan Revisi</h4>
    </div>
    <div class="modal-body">
      <div>
        <form class="form-horizontal" id="form-revisi">
          <input type="hidden" id="kd_usulan_diterima" name="Kd_Ta_Forum_Lingkungan" value="<?= $Kd_Ta_Forum_Lingkungan ?>">
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
              <input type="text" id="jumlah" class="form-control hitung harus_isi" name="Jumlah" value="<?= $usulan->Jumlah ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Satuan</label>
            <div class="col-sm-8">
              <select class="form-control" name="Satuan">
                <?php
                  $Kd_Satuans = $usulan->Kd_Satuan;
                  foreach ($satuan as $key => $val_satuan) :
                    $Kd_Satuan = $val_satuan['Kd_Satuan'];
                    $Uraian = $val_satuan['Uraian'];
                    if($Kd_Satuans == $Kd_Satuan)
                      $selected = 'selected';
                    else
                      $selected = '';

                    ?>
                      <option value="<?= $Kd_Satuan ?>" <?= $selected?> ><?= ucfirst($Uraian) ?></option>
                    <?php
                  endforeach;
                ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Harga</label>
            <div class="col-sm-8">
              <input type="text" id="harga" class="form-control nomor hitung harus_isi" name="Harga" value="<?= $usulan->Harga_Satuan ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Total</label>
            <div class="col-sm-8">
              <input type="text" readonly id="total" class="form-control nomor hitung harus_isi" name="Total" value="<?= $usulan->Harga_Total ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Bidang Pembangunan</label>
            <div class="col-sm-8">
              <select class="form-control" name="Kd_Pem">
                <?php
                  $Kd_Pem = $usulan->Kd_Pem;
                  foreach ($bidangpem as $key => $bidpem) :
                    if ($key == $Kd_Pem) 
                      $selected = 'selected';
                    else
                      $selected = '';
                    ?>
                      <option value="<?= $key?>" <?= $selected ?> > <?= ucfirst($bidpem) ?> </option>
                    <?php
                  endforeach;
                ?>
              </select>
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
              <textarea id="keterangan-diterima" class="form-control harus_isi" name="Keterangan" rows="3"></textarea>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
      <button type="button" class="btn btn-primary" id="btn-terima-revisi">Simpan</button>
    </div>
  </div>
</div>

<script type="text/javascript">
  $("#btn-terima-revisi").click(function(){
    var keterangan = $(".harus_isi").val();

    if (keterangan == '') {
      alert('Seluruh Form Harus Terisi!');
    }
    else{
      $(this).attr("disabled", true);
      //alert('index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-revisi-usulan&'+$('#form-revisi').serialize());
      $.ajax({ 
        type: "GET",
        url:'index.php?r=ta-kelurahan-verifikasi-usulan-lingkungan/proses-revisi-usulan',
        data:$('#form-revisi').serialize(),
        success: function(isi){
          alert(isi);
          get_usulan(); 
          load_jumlah();
          $('#modal_revisi').modal('hide');
        },
        error: function(){
          alert("failure");
        }
      });
    }
  });

  $('.nomor').number( true, 2, ',', '.' );

  $(".hitung").keyup(function(){
      var jumlah = $('#jumlah').val();
      var harga = $('#harga').val();
      var total = jumlah*harga;
      //alert(total);
      $('#total').val(total);
  });
</script>