            <h3 style="text-align: center;">
            <BR>REKAPITULASI USULAN POKIR 
            <BR>MASA RESES <?= $reses->Masa_Reses ?>, TAHUN <?= $Tahun ?></h3>
        
            <BR>
                        <div class="table-data-wrap">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;">
                                            No
                                        </th>
                                        <th style="text-align:center;">
                                            Usulan
                                        </th>
                                        <th style="text-align:center;">
                                            Jumlah/vol
                                        </th>
                                        <th style="text-align:center;">
                                            Kecamatan
                                        </th>
                                        <th style="text-align:center;">
                                            Detail Lokasi
                                        </th>
										<th style="text-align:center;">
                                            OPD
                                        </th>
                                        <th style="text-align:center;">
                                            Tanggal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
<?php
$no = 1;
if ($data == null) {
    echo '<tr><td colspan="8" style="text-align: center;"><i><h2>NIHIL</h2></i></td></tr>';
} else {
    foreach ($data as $key => $value) {

        echo '
                        <tr>
                          <td>
                            ' . $no++ . '
                          </td>
                          <td>
                              ' . $value["Jenis_Usulan"] . '
                              <br><br>
                              <strong>Permasalahan</strong>
                              <br>
                              ' . $value["Nm_Permasalahan"] . '
                             <br>
                              
                             </td>
                          <td>
                              ' . $value["Jumlah"] . '
                              ' . $value->satuan->Uraian . '
                          </td>
                          <td>'.$value->kecamatan['Nm_Kec'].'
                          </td>
                          <td>
                              '.$value["Detail_Lokasi"].'<br />
                              Lat: ' . $value["Latitute"] . ' <br/>
                              Long: ' . $value["Longitude"] . '
                          </td>
						  <td>
							'.
							$SubUnit($value->Kd_Urusan,$value->Kd_Bidang,$value->Kd_Unit,$value->Kd_Sub)
							.'
						  </td>
                          <td>
                              ' . Yii::$app->formatter->asDateTime($value["Tanggal"], 'dd MM yyyy, H:i:s') . '
                              WIB
                           
                          </td>

                          </tr>
                          ';
    }
}
?>

                                </tbody>
                            </table>
            <table style="text-align: center;width: 100%">
                <tr><td> </td><td></tr>
                <tr><td colspan="2">Mengetahui</td><td colspan="2"> </td></tr>
                <tr><td colspan="4" > </td></tr>
                <tr><td>Perwakilan Anggota DPRD</td><td>Sekretariat Dewan</td></tr>
                <tr><td style="height: 75px"></td><td></td><td></tr>
                <tr><td>(.....................................................)</td><td>(.....................................................)</td></tr>
                <tr><td></td><td>NIP : .............................................</td></tr>
            </table>
                        </div> 