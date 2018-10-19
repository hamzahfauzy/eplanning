<h2 align="center">Prioritas Kegiatan Berdasar Kriteri</h2>
<table cellpadding="5" border=1>
  <tr>
    <th>No</th>
    <th>Kegiatan</th>
    <?php foreach ($kriteria as $val) { ?>
    <th><?=$val->Kriteria;?></th>
    <?php } ?>
    <th>Total Skor</th>
    <th>Urutan Prioritas</th>
  </tr>
  <tr>
    <?php for($i=1;$i<10;$i++){ ?>
    <th>(<?=$i;?>)</th>
    <?php } ?>
  </tr>
<?php 
$no = 1;
if(count($data)>0){
  foreach($data as $rows): 
  $skor = unserialize($rows->Rincian_Skor);
  if(!(count($skor) > 5)){
  ?>
  <tr>
    <td><?=$no;$no++;?></td>
    <td><?=$rows->Jenis_Usulan;?></td>
    <?php for($i=1;$i<6;$i++){ ?>
    <td><?=$skor[$i];?></td>
    <?php } ?>
    <td><?=$rows->Skor;?></td>
    <td></td>  
  </tr>
<?php }else{ ?>
  <tr>
    <td><?=$no;$no++;?></td>
    <td><?=$rows->Jenis_Usulan;?></td>
    <?php for($i=1;$i<6;$i++){ ?>
    <td>-</td>
    <?php } ?>
    <td><?=$rows->Skor;?></td>
    <td></td>  
  </tr>
<?php  
  }
  endforeach; 
}else{
  echo "<tr><td colspan=10><center>Tidak Ada Data</center></td></tr>";
}
?>
<script type="text/javascript">
  window.onload = window.print();
</script>