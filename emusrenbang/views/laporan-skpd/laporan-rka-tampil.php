<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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

?>

<div class="box-header">
    <?= Html::a('&nbsp;Cetak&nbsp;', ['laporan-rka-cetak', 'program' => $Kegiatan['Kd_Prog'], 'kegiatan' => $Kegiatan['Kd_Keg'] ], 
            ['class' => 'btn btn-primary pull-right', 'target' => '_blank']);
    ?>
</div>
<table width="100%" class="table table-bordered">
    <tr>
        <th colspan="6" style="text-align:center;">RINCIAN ANGGARAN BELANJA LANGSUNG MENURUT PROGRAM DAN PER KEGIATAN ORGANISASI PERANGKAT DAERAH</th>
    </tr>
    <tr>
        <th rowspan="2" style="text-align:center;padding:4px;">KODE REKENING</th>
        <th rowspan="2" style="text-align:center;padding:4px;">URAIAN</th>
        <th colspan="3" style="text-align:center;padding:4px;">RINCIAN PERHITUNGAN</th>
        <th rowspan="2" style="text-align:center;padding:4px;">JUMLAH (Rp)</th>
    </tr>
    <tr>
        <th style="text-align:center;padding:4px;">Volume</th>
        <th style="text-align:center;padding:4px;">Satuan</th>
        <th style="text-align:center;padding:4px;">Harga Satuan</th>
    </tr>
    <tr>
        <th style="text-align:center;">1</th><th style="text-align:center;">2</th><th style="text-align:center;">3</th><th style="text-align:center;">4</th><th style="text-align:center;">5</th><th style="text-align:center;">6</th>
    </tr>
        <?php foreach ($data->getTaBelanjaRincSubMany()->groupBy('Kd_Rek_1')->select('*,sum(Total) as jumlah')->all() as $key_1 => $value_1): ?>   
            <tr>
                <td style="padding:4px;"><?= @$value_1->Kd_Rek_1 ?></td>
                <td style="padding:4px;"><?= @$value_1->refRek1->Nm_Rek_1 ?></td>
                <td style="padding:4px;"></td>
                <td style="padding:4px;"></td>
                <td style="padding:4px;"></td>
                <td style="padding:4px;text-align:right;"><?= number_format(@$value_1->jumlah,2,',','.') ?></td>
            </tr>
            <?php foreach ($value_1->getKdRek2s()->groupBy('Kd_Rek_1,Kd_Rek_2')->select('*,sum(Total) as jumlah')->all() as $key_2 => $value_2): ?>
                <tr>
                    <td style="padding:4px;"><?= @$value_2->Kd_Rek_1.".".$value_2->Kd_Rek_2 ?></td>
                    <td style="padding:4px;padding-left:8px;"><?= @$value_2->refRek2->Nm_Rek_2 ?></td>
                    <td style="padding:4px;"></td>
                    <td style="padding:4px;"></td>
                    <td style="padding:4px;"></td>
                    <td style="padding:4px;text-align:right;"><?= number_format(@$value_2->jumlah,2,',','.') ?></td>
                </tr>
                <?php foreach ($value_2->getKdRek3s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3')->select('*,sum(Total) as jumlah')->all() as $key_3 => $value_3): ?>
                    <tr>
                        <td style="padding:4px;"><?= @$value_3->Kd_Rek_1.".".$value_3->Kd_Rek_2.".".$value_3->Kd_Rek_3 ?></td>
                        <td style="padding:4px;padding-left:12px;"><?= @$value_3->refRek3->Nm_Rek_3 ?></td>
                        <td style="padding:4px;"></td>
                        <td style="padding:4px;"></td>
                        <td style="padding:4px;"></td>
                        <td style="padding:4px;text-align:right;"><?= number_format(@$value_3->jumlah,2,',','.') ?></td>
                    </tr>
                    <?php foreach ($value_3->getKdRek4s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4')->select('*,sum(Total) as jumlah')->all() as $key_4 => $value_4): ?>
                        <tr>
                            <td style="padding:4px;"><?= @$value_4->Kd_Rek_1.".".$value_4->Kd_Rek_2.".".$value_4->Kd_Rek_3.".".$value_4->Kd_Rek_4 ?></td>
                            <td style="padding:4px;padding-left:16px;"><?= @$value_4->refRek4->Nm_Rek_4 ?></td>
                            <td style="padding:4px;"></td>
                            <td style="padding:4px;"></td>
                            <td style="padding:4px;"></td>
                            <td style="padding:4px;text-align:right;"><?= number_format(@$value_4->jumlah,2,',','.') ?></td>
                        </tr>
                        <?php foreach ($value_4->getKdRek5s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4,Kd_Rek_5')->select('*,sum(Total) as jumlah')->all() as $key_5 => $value_5): ?>
                            <tr>
                                <td style="padding:4px;"><?= @$value_5->Kd_Rek_1.".".$value_5->Kd_Rek_2.".".$value_5->Kd_Rek_3.".".$value_5->Kd_Rek_4.".".$value_5->Kd_Rek_5 ?></td>
                                <td style="padding:4px;padding-left:20px;"><?= @$value_5->refRek5->Nm_Rek_5 ?></td>
                                <td style="padding:4px;"></td>
                                <td style="padding:4px;"></td>
                                <td style="padding:4px;"></td>
                                <td style="padding:4px;text-align:right;"><?= number_format(@$value_5->jumlah,2,',','.') ?></td>
                            </tr>
                            <?php foreach ($value_5->getKdRek6s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4,Kd_Rek_5,No_Rinc')->select('*,sum(Total) as jumlah')->all() as $key_6 => $value_6): ?>
                                <tr>
                                    <td style="padding:4px;"></td>
                                    <td style="padding:4px;padding-left:24px;"><?= @$value_6->taBelanjaRinc->Keterangan ?></td>
                                    <td style="padding:4px;"></td>
                                    <td style="padding:4px;"></td>
                                    <td style="padding:4px;"></td>
                                    <td style="padding:4px;text-align:right;"><?= number_format(@$value_6->jumlah,2,',','.') ?></td>
                                </tr>
                                <?php foreach ($value_6->getKdRek7s()->groupBy('Kd_Rek_1,Kd_Rek_2,Kd_Rek_3,Kd_Rek_4,Kd_Rek_5,No_Rinc,No_ID')->all() as $key_7 => $value_7): ?>
                                    <tr>

                                    <?php 
                                      $lokasi = '';
                                      if ($value_7->Lokasi != '') {
                                        $lokasi = " di ".$value_7->Lokasi;
                                      }
                                    ?>
                                        <td style="padding:4px;"></td>
                                        <td style="padding:4px;padding-left:32px;"><strong>- </strong><?= @$value_7->Keterangan.$lokasi ?></td>
                                        <td style="padding:4px;text-align:center;"><?= @$value_7->Jml_Satuan ?></td>
                                        <td style="padding:4px;text-align:center;"><?= @$value_7->Satuan123 ?></td>
                                        <td style="padding:4px;text-align:right;"><?= number_format(@$value_7->Nilai_Rp,2,',','.') ?></td>
                                        <td style="padding:4px;text-align:right;"><?= number_format(@$value_7->Total,2,',','.') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
</table>