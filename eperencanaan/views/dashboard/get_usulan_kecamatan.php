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
                                    if (isset($val->lingkungan->Nm_Lingkungan) AND isset($val->kelurahan->Nm_Kel)) {
                                        echo $val->lingkungan->Nm_Lingkungan.", Kel.".$val->kelurahan->Nm_Kel.", Kec.".$val->kecamatan->Nm_Kec;
                                    }
                                    else if (!isset($val->lingkungan->Nm_Lingkungan) AND isset($val->kelurahan->Nm_Kel)) {
                                        echo "Kel.".$val->kelurahan->Nm_Kel.", Kec.".$val->kecamatan->Nm_Kec;
                                    }
                                    else {
                                        echo "Kec.".$val->kecamatan->Nm_Kec;
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
                            <?= '<span class="label label-success">Usulan</span>'.'<br/>'.$val->Jenis_Usulan.
                                '<br/><br/>
                                <span class="label label-danger">Permasalahan</span>'.'<br/>'.$val->Nm_Permasalahan 
                            ?>
                        </td>
                        <td><?= $val->Jumlah.' '.$val->satuan->Uraian ?></td>
                    </tr>
                    <?php
                endforeach ;
            ?>
        </tbody>
    </table>
</div>