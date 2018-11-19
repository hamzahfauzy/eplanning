<?php  
    use yii\helpers\Html;
?>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Asal Usulan</th>
                <th>Lokasi</th>
                <th>Usulan</th>
                <th>Jumlah/Vol</th>
                <th>Dokumen</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 0;
                foreach ($data as $val) :
                    $no++;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td style="text-transform: capitalize;">
                            <strong>
                                <?php  
                                    if (isset($val->lingkungan->Nm_Lingkungan)) {
                                        echo $val->lingkungan->Nm_Lingkungan.", Kel.".$val->kelurahan->Nm_Kel.", Kec.".$val->kecamatan->Nm_Kec;
                                    }
                                    else {
                                        echo "Kel.".$val->kelurahan->Nm_Kel.", Kec.".$val->kecamatan->Nm_Kec;
                                    }
                                ?>
                            </strong>
                        </td>
                        <td>
                            <?php  
                                if (isset($val->Detail_Lokasi)) { ?>
                                    <p><?= $val->Detail_Lokasi ?></p>
                                    <?php 
                                        if ($val->Latitute == NULL OR !isset($val->Latitute) OR empty($val->Latitute) OR $val->Latitute == '') {
                                            echo "";
                                        }
                                        else { ?>
                                            <a href="https://www.google.com/maps/@<?=$val->Latitute?>,<?=$val->Longitude?>,17z" target="_blank"><span class="label label-info"><i class="fa fa-map-marker"></i>Peta Lokasi</span></a>
                                        <?php }
                                    ?>
                                <?php }
                                else {
                                    echo "-";
                                }
                            ?>
                        </td>
                        <td>
                            <span class="label label-success">Usulan</span><br>
                            <p><?= $val->Jenis_Usulan ?></p>
                            <span class="label label-danger">Permasalahan</span><br>
                            <p><?= $val->Nm_Permasalahan ?></p>
                        </td>
                        <td><?= $val->Jumlah.' '.$val->satuan->Uraian ?></td>
                        <td>  
                            <?php  
                                if (isset($val->taMusrenbangKelurahan->Kd_Ta_Musrenbang_Kelurahan)) {

                                    $foto = $val->taMusrenbangKelurahan->getTaUsulanKelurahanMedia()->all();

                                    foreach ($foto as $value) {
                                        $nama_file = $value->kdMedia->Nm_Media;
                                        $url = "index.php?r=dashboard/lihat-file&nama_file=".$nama_file;

                                        echo '<button type="button" class="btn btn-primary btn-xs lihat_file" data-url="'.$url.'">Lihat File</button>';
                                    }
                                }
                                else {
                                    echo "";
                                }
                            ?>
                        </td>
                    </tr>
                    <?php
                endforeach ;
            ?>
        </tbody>
    </table>
</div>