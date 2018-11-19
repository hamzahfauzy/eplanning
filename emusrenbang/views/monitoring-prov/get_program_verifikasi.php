<?php
foreach ($data as $key => $value):
?>
  <tr class="dat-col">
    <td class="dat-program" 
        data-key="<?= $value->Kd_Urusan."|".$value->Kd_Bidang."|".$value->Kd_Unit."|".$value->Kd_Sub."|".$value->Kd_Prog ?>"
        data-toggle="tooltip" 
        data-placement="top" 
        title="<?= $value->Ket_Prog ?>">
      <?= substr($value->Ket_Prog, 0, 40); ?>
      (<?= $value->getTaKegiatans()->count() ?>)
    </td>
  </tr>
<?php
endforeach;
?>

<script type="text/javascript">
$(".dat-program").click(function(){
	var target = "#kegiatan-wrap";
	$(target).html("mengambil data ...");
	var key = $(this).data('key');
	//alert(key);
	$.ajax({ 
    type: "GET",
    url:'index.php?r=monitoring-prov/get-kegiatan-verifikasi',
    data:{key:key},
    success: function(isi){
      $(target).html(isi);
    },
    error: function(){
      alert("Ambil data gagal");
			$(target).html("");
    }
  });
});

$(".dat-col").click(function(){
    //$(".dat-col").removeClass("active");
    $(this)
     .closest('table')
     .find('tr').removeClass('active');
    $(this).addClass("active");
});

</script>