<?php
$total_jumlah=0;
$no=0;
	foreach ($data as $key => $value) :
    $no++;
  	$lingkungan = $value['lingkungan'];
		$usulan = $value['usulan'];
		$jumlah = $value['jumlah'];
		$total_jumlah+=$jumlah;
		$satuan = $value['satuan'];
		$harga = $value['harga'];
  ?>
    <tr>
      <td><?= $no ?></td>
      <td><?= $lingkungan ?></td>
      <td><?= $usulan ?></td>
      <td><?= $jumlah ?></td>
      <td><?= $satuan ?></td>
      <td><?= $harga ?></td>
      <td><a href="#" class="btn-hapus-usulan" title="Hapus Usulan" data-kode="<?= $key ?>"><i class="glyphicon glyphicon-remove"></i></a></td>
    </tr>
	<?php
  endforeach;
?>
<tr>
  <td></td>
  <td></td>
  <td></td>
  <td id="total_jumlah"><?= $total_jumlah ?></td>
  <td></td>
  <td></td>
  <td></td>
</tr>


<script type="text/javascript">
	$(".btn-hapus-usulan").click(function(){
	  var kode = $(this).data('kode');
	  $.ajax({ 
	    type: "GET",
	    url:'index.php?r=ta-musrenbang-kelurahan%2Fhapus-cookie-usulan',
	    data: {Kode:kode},
	    success: function(isi){
	      alert(isi);
	      get_usulan_pilih(); // ada di kompilasi.js
	    },
	    error: function(){
	      alert("failure");
	    }
	  });
	});
</script>