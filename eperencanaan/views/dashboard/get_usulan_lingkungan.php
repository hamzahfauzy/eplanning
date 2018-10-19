<?php  
	use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\Modal;


$this->registerJsFile(
    '@web/js/musrenbang/lihat_usulan.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

?>


            <?php
                $no = 0;
                foreach ($data as $val) :
                    $no++;
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td style="text-transform: capitalize;">
                            <strong>
                                <?= $val->lingkungan->Nm_Lingkungan.', '
                                    .'Kel.'.$val->kelurahan->Nm_Kel.', '
                                    .'Kec.'.$val->kecamatan->Nm_Kec
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
                                if (isset($val->taForumLingkungan->Kd_Ta_Forum_Lingkungan)) {

                                    $foto = $val->taForumLingkungan->getTaUsulanLingkunganMedia()->all();

                                    foreach ($foto as $value) {
                                        $nama_file = $value->kdMedia->Nm_Media;
                                        $url = "index.php?r=dashboard/lihat-file&nama_file=".$nama_file;

                                        echo '<button type="button" class="btn btn-primary btn-xs lihat_file" data-url="'.$url.'">File</button>';
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
            

<script type="text/javascript">
  $(".lihat_file").click(function(){
    var alamat = $(this).data('url');
    //alert(alamat);
    $('#lihatFileModal').modal('show')
          .find('.isi-modal')
          .html("Loading...");

    $.ajax({ 
      type: "POST",
      url: alamat,
      data:'',
      success: function(isi){
        $('#lihatFileModal')
          .find('.isi-modal')
          .html(isi);
      },
      error: function(){
        alert("failure");
      }
    });
  });
</script>