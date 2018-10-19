<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

$no = 1;
foreach ($NASUsulan1 as $value) :
    ?>
    <tr><td><?php echo $no; ?></td>

        <td> <b>Permasalahan:</b><br/>
            <p><?php echo $value->Nm_Permasalahan; ?></p>
            <b>Usulan:</b>
            <p><?php echo $value->Jenis_Usulan; ?></p>
			
			
            (<?php echo $value->kdPem->Bidang_Pembangunan; ?>)
        </td>
        <td> <?php echo @$value->tahun->Nm_Prioritas_Pembangunan_Kota; ?></td>

        <td align="center">
		<p><?php echo $value->kdProv->Nm_Kel; ?> </p> 
        <?php echo @$value->kdLingkungan->Nm_Lingkungan; ?><!-- Lingkungan -->
		<br>
        <?php echo @$value->kdJalan->Nm_Jalan; ?><br> <!-- Jalan -->
		<button class="btn btn-danger" onclick="showmodallokasi(['<?=$value->Latitute;?>','<?=$value->Longitude;?>']);"><span class="glyphicon glyphicon-map-marker"></span></button></td>
        <td><?php echo ($value->Jumlah . ' ' . $value->kdSatuan->Uraian) ?></td>
        <td style="text-align: right"><?php echo \Yii::$app->zultanggal->ZULgetcurrency($value->Harga_Total) ?></td>
        <td><?=$opd($value->Kd_Urusan,$value->Kd_Bidang);?> 
		
		<!-- SKPD --> </td>
        <td align="Center"><button class="btn btn-success" onclick="showmodaldokumen(<?=$value->Kd_Ta_Musrenbang_Kelurahan;?>);"><span class="glyphicon glyphicon-folder-close"></span></button>
			
		<p> <b> <center>
		<?php if(empty($value->status)) { ?>
		<font style="color: white; background: red"> Belum Dikirim </font>
		<?php
		}
		else
		{ ?>
	
		
        
	<a class="btn btn-success" href="index.php?r=ta-musrenbang-kecamatan/ubah&Kd_Ta_Musrenbang_Kelurahan=<?=$value->Kd_Ta_Musrenbang_Kelurahan;?>">Ubah</a>
			<?=Html::button('Dokumen', ['class' => 'btn btn-primary', 'id' => 'btn-dokumen','onclick'=>'setID('.$value->Kd_Ta_Musrenbang_Kelurahan.')']); ?>
		
		<?php }
		
		
		?> </b> </center></p>
		
		</td>

    <tr>
    <?php $no++; endforeach; ?>
<!-- modal musrenbang kelurahan -->
<!-- /.modal form -->

