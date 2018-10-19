<?php
use common\models\TaKegiatan;
function numbertell($x){
    // if ($x) return 0;
    $abil = [
            "", 
            "Satu", "Dua", "Tiga", 
            "Empat", "Lima", "Enam", 
            "Tujuh", "Delapan", "Sembilan", 
            "Sepuluh", "Sebelas"
    ];
    
    if ($x < 12) return " ".$abil[$x];
    elseif ($x<20) return numbertell($x-10)." Belas";
    elseif ($x<100) return numbertell($x/10)." Puluh".numbertell($x%10);
    elseif ($x<200) return " Seratus".numbertell($x-100);
    elseif ($x<1000) return numbertell($x/100)." Ratus".numbertell($x % 100);
    elseif ($x<2000) return " Seribu".numbertell($x-1000);
    elseif ($x<1000000) return numbertell($x/1000)." Ribu".numbertell($x%1000);
    elseif ($x<1000000000) return numbertell($x/1000000)." Juta".numbertell($x%1000000);
    elseif ($x<1000000000000) return numbertell($x/1000000000)." Milyar".numbertell($x%1000000000);
    elseif ($x<1000000000000000) return numbertell($x/1000000000000)." Trilyun".numbertell($x%1000000000000);
}

$indikator = [
    isset($data->taIndikators[0]) ? [$data->taIndikators[0]->Tolak_Ukur, $data->taIndikators[0]->Target_Angka, $data->taIndikators[0]->Target_Uraian] : ['', 0, ''],
    isset($data->taIndikators[1]) ? [$data->taIndikators[1]->Tolak_Ukur, $data->taIndikators[1]->Target_Angka, $data->taIndikators[1]->Target_Uraian] : ['', 0, ''],
]

?>

<table width="100%" style="border-collapse: collapse">
    <tr>
        <td rowspan="2" width="9%" style="border: 1px solid black;text-align:center;padding:5px;"><img width="60px" src="images/Logo1.png"></td>
        <th style="border: 1px solid black;padding:5px;"><center>RENCANA KERJA DAN ANGGARAN<br> ORGANISASI PERANGKAT DAERAH</center></th>
        <th width="9%" rowspan="2" style="border: 1px solid black;padding:5px;text-align:center;">Formulir RKA OPD 2.2.1</th>
    </tr>
    <tr>
        <td style="border: 1px solid black;"><center>Pemerintahan Kabupaten Asahan <br> Tahun Anggaran : <?= $Tahun + 1 ?></center></td>
    </tr>
</table>
<table width="100%" style="border-bottom: 1px solid #000000;border-right: 1px solid #000000;border-left: 1px solid #000000;">
    <tr>
        <th width="17%" style="text-align:left;padding:4px;">Urusan Pemerintahan</th><th width="1%"> : </th><td width="15%"> <?= $data->Kd_Urusan ?> </td><td colspan="2" style="padding-left:8px;"><i><?= $data->urusan->Nm_Urusan ?></i></td>
    </tr>
    <tr>
        <th style="text-align:left;padding:4px;">Bidang</th><th> : </th><td> <?= $data->Kd_Urusan.'.'.$data->Kd_Bidang ?></td><td style="padding-left:8px;"><i><?= $data->bidang->Nm_Bidang ?></i></td>
    </tr>
    <tr>
        <th style="text-align:left;padding:4px;">Unit</th><th> : </th><td> <?= $data->Kd_Urusan.'.'.$data->Kd_Bidang.'.'.$data->Kd_Unit ?></td><td style="padding-left:8px;"><i><?= $data->unit->Nm_Unit ?></i></td>
    </tr>
    <tr>
        <th style="text-align:left;padding:4px;">Sub Unit</th><th> : </th><td> <?= $data->Kd_Urusan.'.'.$data->Kd_Bidang.'.'.$data->Kd_Unit.'.'.$data->Kd_Sub ?></td><td style="padding-left:8px;"><i><?= $data->refSubUnit->Nm_Sub_Unit ?></i></td>
    </tr>
    <tr>
        <th style="text-align:left;padding:4px;">Program</th><th> : </th><td> <?= $data->Kd_Urusan.'.'.$data->Kd_Bidang.'.'.$data->Kd_Unit.'.'.$data->Kd_Sub.'.'.$data->Kd_Prog ?></td><td style="padding-left:8px;"><i><?= $data->program->Ket_Program ?></i></td>
    </tr>
    <tr>
        <th style="text-align:left;padding:4px;">Kegiatan</th><th> : </th><td> <?= $data->Kd_Urusan.'.'.$data->Kd_Bidang.'.'.$data->Kd_Unit.'.'.$data->Kd_Sub.'.'.$data->Kd_Prog.'.'.$data->Kd_Keg ?></td><td style="padding-left:8px;"><i><?= $data->Ket_Kegiatan ?></i></td>
    </tr>
</table>
<table width="100%" style="border-bottom: 1px solid #000000;border-right: 1px solid #000000;border-left: 1px solid #000000;">
    <tr>
        <th width="17%" style="text-align:left;padding:4px;">Lokasi Kegiatan</th><th width="1%"> : </th><td> <?= $data->Lokasi ?></td>
    </tr>
</table>
<table width="100%" style="border-bottom: 1px solid #000000;border-right: 1px solid #000000;border-left: 1px solid #000000;">
    <tr>
        <th width="17%" style="padding:4px;text-align:left;">Jumlah Tahun n - 1</th><th width="1%"> : </th><td width="2%"> Rp </td><td width="13%" style="text-align:right;"> 00,00</td><td style="padding-left:8px;"></td>
    </tr>
    <tr>
        <th style="padding:4px;text-align:left;">Jumlah Tahun n </th><th width="1%"> : </th><td width="2%"> Rp </td><td width="13%" style="text-align:right"> <?= number_format($data->getTaBelanjaRincSubMany()->sum('Total'),2,',','.') ?></td><td style="padding-left:8px;"><i>( <?= numbertell($data->getTaBelanjaRincSubMany()->sum('Total'))." Rupiah" ?> )</i></td>
    </tr>
    <tr>
	<?php
			$nt1=TaKegiatan::find()
			->where (['Kd_Urusan'=>$data->Kd_Urusan,
					  'Kd_Bidang'=>$data->Kd_Bidang,
					  'Kd_Unit'=>$data->Kd_Unit,
					  'Kd_Sub'=>$data->Kd_Sub,
					  'Kd_Prog'=>$data->Kd_Prog,
					  'Kd_Keg'=>$data->Kd_Keg])
			->all();
			foreach ($nt1 as $xxt1):
				$xt1=$xxt1->Pagu_Anggaran_Nt1;
			endforeach;
					   
			
		?>
        <th style="padding:4px;text-align:left;">Jumlah Tahun n + 1</th><th width="1%"> : </th><td width="2%"> Rp </td><td width="13%" style="text-align:right"> <?=number_format(@$xt1,2,',','.') ?></td><td style="padding-left:8px;"><i>( <?= numbertell(@$xt1) . " Rupiah"?> )</i></td>
    </tr>
</table>
<table width="100%" style="border-collapse: collapse;border-bottom: 1px solid #000000;border-right: 1px solid #000000;border-left: 1px solid #000000;">
    <tr>
        <th colspan="3" style="padding:4px;text-align:center;">INDIKATOR & TOLOK UKUR KINERJA BELANJA LAGNSUNG</th>
    </tr>
    <tr>
        <th width="14%" style="border: 1px solid black;text-align:left;padding:4px;text-align:center;">INDIKATOR</th><th width="50%" style="padding:4px;border: 1px solid black;text-align:center;">TOLOK UKUR KINERJA</th><th style="text-align:center;padding:4px;border: 1px solid black;">TARGET KINERJA</th>
    </tr>
    <tr>
        <th width="14%" style="border: 1px solid black;text-align:left;padding:4px;">MASUKAN</th><td width="50%" style="padding:4px;border: 1px solid black;"><?= $indikator[0][0] ?></td><td style="padding:4px;border: 1px solid black;"><?= ($indikator[0][2] =='Rupiah') ? "Rp. ".number_format($indikator[0][1],0,'.','.') : number_format($indikator[0][1],0,'.','.').' '.$indikator[0][2] ?></td>
    </tr>
    <tr>
        <th width="14%" style="border: 1px solid black;text-align:left;padding:4px;">KELUARAN</th><td width="50%" style="padding:4px;border: 1px solid black;"><?= $indikator[1][0] ?></td><td style="padding:4px;border: 1px solid black;"><?= ($indikator[1][2] =='Rupiah') ? "Rp. ".number_format($indikator[1][1],0,'.','.') : number_format($indikator[1][1],0,'.','.').' '.$indikator[1][2] ?></td>
    </tr>
    <tr>
        <th colspan="3" style="border: 1px solid black;text-align:left;padding:4px;">Kelompok Sasaran Kegiatan&emsp;&emsp;:<?= $data->Kelompok_Sasaran ?></th>
    </tr>
</table>
<table width="100%" style="border-collapse: collapse;border: 1px solid #000000;">
    <tr>
        <th colspan="6" style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;text-align:center;">RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN SATUAN KERJA PERANGKAT DAERAH</th>
    </tr>
    <tr>
        <th rowspan="2" style="border: 1px solid black;text-align:center;padding:4px;">KODE REKENING</th>
        <th rowspan="2" style="border: 1px solid black;text-align:center;padding:4px;">URAIAN</th>
        <th colspan="3" style="border: 1px solid black;text-align:center;padding:4px;">RINCIAN PERHITUNGAN</th>
        <th rowspan="2" style="border: 1px solid black;text-align:center;padding:4px;">JUMLAH (Rp)</th>
    </tr>
    <tr>
        <th style="border: 1px solid black;text-align:center;padding:4px;">Volume</th>
        <th style="border: 1px solid black;text-align:center;padding:4px;">Satuan</th>
        <th style="border: 1px solid black;text-align:center;padding:4px;">Harga Satuan</th>
    </tr>
    <tr>
        <th style="border: 1px solid black;text-align:center;">1</th><th style="border: 1px solid black;text-align:center;">2</th><th style="border: 1px solid black;text-align:center;">3</th><th style="border: 1px solid black;text-align:center;">4</th><th style="border: 1px solid black;text-align:center;">5</th><th style="border: 1px solid black;text-align:center;">6</th>
    </tr>
        <?php foreach ($data->getTaBelanjaRincSubMany()->select('*,sum(Total) as jumlah')->groupBy('Kd_Rek_1')->all() as $key_1 => $value_1): ?>   
            <tr>
                <td style="border-right: 1px solid black;padding:4px;"><?= @$value_1->Kd_Rek_1 ?></td>
                <td style="border-right: 1px solid black;padding:4px;"><?= @$value_1->refRek1->Nm_Rek_1 ?></td>
                <td style="border-right: 1px solid black;padding:4px;"></td>
                <td style="border-right: 1px solid black;padding:4px;"></td>
                <td style="border-right: 1px solid black;padding:4px;"></td>
                <td style="border-right: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_1->jumlah,2,',','.') ?></td>
            </tr>
            <?php foreach ($value_1->getKdRek2s()->groupBy('Kd_Rek_1,Kd_Rek_2')->select('*,sum(Total) as jumlah')->all() as $key_2 => $value_2): ?>
                <tr>
                    <td style="border-right: 1px solid black;padding:4px;"><?= @$value_2->Kd_Rek_1.".".$value_2->Kd_Rek_2 ?></td>
                    <td style="border-right: 1px solid black;padding:4px;padding-left:8px;"><?= @$value_2->refRek2->Nm_Rek_2 ?></td>
                    <td style="border-right: 1px solid black;padding:4px;"></td>
                    <td style="border-right: 1px solid black;padding:4px;"></td>
                    <td style="border-right: 1px solid black;padding:4px;"></td>
                    <td style="border-right: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_2->jumlah,2,',','.') ?></td>
                </tr>
                <?php foreach ($value_2->getKdRek3s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3')->select('*,sum(Total) as jumlah')->all() as $key_3 => $value_3): ?>
                    <tr>
                        <td style="border-right: 1px solid black;padding:4px;"><?= @$value_3->Kd_Rek_1.".".$value_3->Kd_Rek_2.".".$value_3->Kd_Rek_3 ?></td>
                        <td style="border-right: 1px solid black;padding:4px;padding-left:12px;"><?= @$value_3->refRek3->Nm_Rek_3 ?></td>
                        <td style="border-right: 1px solid black;padding:4px;"></td>
                        <td style="border-right: 1px solid black;padding:4px;"></td>
                        <td style="border-right: 1px solid black;padding:4px;"></td>
                        <td style="border-right: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_3->jumlah,2,',','.') ?></td>
                    </tr>
                    <?php foreach ($value_3->getKdRek4s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4')->select('*,sum(Total) as jumlah')->all() as $key_4 => $value_4): ?>
                        <tr>
                            <td style="border-right: 1px solid black;padding:4px;"><?= @$value_4->Kd_Rek_1.".".$value_4->Kd_Rek_2.".".$value_4->Kd_Rek_3.".".$value_4->Kd_Rek_4 ?></td>
                            <td style="border-right: 1px solid black;padding:4px;padding-left:16px;"><?= @$value_4->refRek4->Nm_Rek_4 ?></td>
                            <td style="border-right: 1px solid black;padding:4px;"></td>
                            <td style="border-right: 1px solid black;padding:4px;"></td>
                            <td style="border-right: 1px solid black;padding:4px;"></td>
                            <td style="border-right: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_4->jumlah,2,',','.') ?></td>
                        </tr>
                        <?php foreach ($value_4->getKdRek5s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4,Kd_Rek_5')->select('*,sum(Total) as jumlah')->all() as $key_5 => $value_5): ?>
                            <tr>
                                <td style="border-right: 1px solid black;padding:4px;"><?= @$value_5->Kd_Rek_1.".".$value_5->Kd_Rek_2.".".$value_5->Kd_Rek_3.".".$value_5->Kd_Rek_4.".".$value_5->Kd_Rek_5 ?></td>
                                <td style="border-right: 1px solid black;padding:4px;padding-left:20px;"><?= @$value_5->refRek5->Nm_Rek_5 ?></td>
                                <td style="border-right: 1px solid black;padding:4px;"></td>
                                <td style="border-right: 1px solid black;padding:4px;"></td>
                                <td style="border-right: 1px solid black;padding:4px;"></td>
                                <td style="border-right: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_5->jumlah,2,',','.') ?></td>
                            </tr>
                            <?php foreach ($value_5->getKdRek6s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4,Kd_Rek_5,No_Rinc')->select('*,sum(Total) as jumlah')->all() as $key_6 => $value_6): ?>
                                <tr>
                                    <td style="border-bottom: 1px dotted black;border-right: 1px solid black;padding:4px;"></td>
                                    <td style="border-bottom: 1px dotted black;border-right: 1px solid black;padding:4px;padding-left:24px;"><?= @$value_6->taBelanjaRinc->Keterangan ?></td>
                                    <td style="border-bottom: 1px dotted black;border-right: 1px solid black;padding:4px;"></td>
                                    <td style="border-bottom: 1px dotted black;border-right: 1px solid black;padding:4px;"></td>
                                    <td style="border-bottom: 1px dotted black;border-right: 1px solid black;padding:4px;"></td>
                                    <td style="border-bottom: 1px dotted black;border-right: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_6->jumlah,2,',','.') ?></td>
                                </tr>
                                <?php foreach ($value_6->getKdRek7s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4,Kd_Rek_5,No_Rinc,No_ID')->all() as $key_7 => $value_7): ?>
                                    <tr>
                                     <?php 
                                      $lokasi = '';
                                      if ($value_7->Lokasi != '') {
                                        $lokasi = " di ".$value_7->Lokasi;
                                      }
                                    ?>
                                        <td style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;padding:4px;"></td>
                                        <td style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;padding:4px;padding-left:32px;"><strong>- </strong><?= @$value_7->Keterangan.$lokasi ?></td>
                                        <td style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;padding:4px;text-align:center;"><?= @$value_7->Jml_Satuan ?></td>
                                        <td style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;padding:4px;text-align:center;"><?= @$value_7->Satuan123 ?></td>
                                        <td style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_7->Nilai_Rp,2,',','.') ?></td>
                                        <td style="border-right: 1px solid black;border-left: 1px solid black;border-bottom: 1px solid black;padding:4px;text-align:right;"><?= number_format(@$value_7->Total,2,',','.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
</table>