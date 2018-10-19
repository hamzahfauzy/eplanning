<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
     <div class="box-header with-border">
		<div class="col-md-12" style="text-align:center;"><h3>Matriks Prioritas Pembangunan Daerah <br> Tahun Anggaran <?= date('Y') + 1 ?></h3></div><div class="col-md-1"></div>
        <div class="col-xs-12"><strong>Urusan &ensp;: </strong><?= $subunit->urusan->Nm_Urusan ?></div>
        <div class="col-xs-12"><strong>Perangkat Daerah&ensp;&ensp;&ensp;: </strong><?= $subunit->Nm_Sub_Unit ?></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td style="text-align:center;vertical-align:middle;">No </td>
                        <td style="text-align:center;vertical-align:middle;">Prioritas Pembangunan Daerah </td>
                        <td style="text-align:center;vertical-align:middle;">Sasaran </td>
                        <td style="text-align:center;vertical-align:middle;">Perangkat Daerah yang Melaksanakan </td>
                        <td style="text-align:center;vertical-align:middle;">Program </td>
                        <td style="text-align:center;vertical-align:middle;">Pagu Indikatif <br>    (Rp)</td>
                    </tr>
                    <tr>
                  
                    <?php for($i=1;$i<=6;$i++): ?>
                        <td style="text-align:center;vertical-align:middle;">(<?= $i ?>)</td>
                    <?php endfor; ?>
                    </tr>
        
                </thead>
                <tbody>
                    <?php 
					$no = 1;
					
                        foreach ($data1 as $key1 => $value1):
						$iterasi=0;
						$jumlah = count($data3[$key1]);
                    ?>
                        <tr>
                            <td rowspan="<?=$jumlah;?>"style="text-align:center;"><?= $no++ ?></td>
                            <td rowspan="<?=$jumlah;?>"><?= $value1 ?></td>
                            <td rowspan="<?=$jumlah;?>"><?= $data2[$key1] ?></td>
                            <td rowspan="<?=$jumlah;?>"><?php print_r($data4[$key1][0]) ?></td>
                            <?php 
							foreach ($data3[$key1] as $key2 => $value2): ?>
							<td><?= $value2 ?></td>
							<td style="text-align:right;">
								<?=number_format($data5[$key1][$key2]);?>
							</td>
							</tr>
							<?php if($iterasi<$jumlah-1){ ?>
							<tr>
							<?php } $iterasi++; ?>
                            <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
	<script>
	window.print();
	</script>