<?php
use yii\helpers\Url;


foreach ($data as $key => $value):
  $url = Url::to(['monitoring-prov/modal-keterangan', 
                              'Tahun' => $value['Tahun'],
                              'Kd_Urusan' => $value['Kd_Urusan'],
                              'Kd_Bidang' => $value['Kd_Bidang'],
                              'Kd_Unit' => $value['Kd_Unit'],
                              'Kd_Sub' => $value['Kd_Sub'],
                              'Kd_Prog' => $value['Kd_Prog'],
                              'Kd_Keg' => $value['Kd_Keg'],
                            ]);
                    ?>
?>
  <tr class="dat-col btn_keterangan" value="<?= $url ?>">
    <td>
      <?php
        if($value->Verifikasi_Bappeda != 0 || $value->Verifikasi_Bappeda != ''){
          echo '<i class="fa fa-check"></i>';
        }
      ?>
    </td>
    <td class="dat-program" 
        data-key="<?= $value->Kd_Urusan."|".$value->Kd_Bidang."|".$value->Kd_Unit."|".$value->Kd_Sub."|".$value->Kd_Prog."|".$value->Kd_Keg ?>"
        data-toggle="tooltip" 
        data-placement="top" 
        title="<?= $value->Ket_Kegiatan ?>">
      <?= substr($value->Ket_Kegiatan, 0, 40); ?>
      (<?= $value->getTaBelanjas()->count() ?>)
    </td>
    <td align = 'right'>
      <?= number_format($value->getBelanjaRincSubs()->sum('Total'),0,',','.') ?>
    </td>
  </tr>
<?php
endforeach;
?>

<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2">
    Ket: <br/>Tanda "<i class="fa fa-check"></i>" sudah di verifikasi
  </td>
</tr>

<script type="text/javascript">

$('.btn_keterangan').on('click', function () {
  $('#keteranganSave').attr('disabled', true);
  // alert('asdfsa');
  //alert($(this).attr('value'));
  $('#keteranganModal').modal('show')
          .find('#keteranganContent')
          .load($(this).attr('value'));
  //$('#tambah_kegiatan_form').trigger("reset");
  $('#keteranganSave').attr('disabled', false);
});

$("#keteranganSave").click(function(){
  $('#keteranganSave').attr('disabled', true);
  var alamat = $('#keterangan_kegiatan_form').attr('action');
  //alert(alamat);
  $.ajax({ 
    type: "POST",
    url:alamat,
    data:$("#keterangan_kegiatan_form").serialize(),
    success: function(isi){
      $('#keteranganContent').html(isi);
      $('#keteranganModal').on('hidden.bs.modal', function () {
          //window.location.reload(true);
          //alert('asdfas');
          $("#program-wrap .dat-col.active .dat-program").trigger('click');
      })
    },
    error: function(){
      alert("Gagal Tambah Kegiatan");
      $('#keteranganSave').attr('disabled', false);
    }
  });
});
</script>