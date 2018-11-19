<?php  

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Widget;
     
?>

<?php echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="table-responsive">
    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'kecamatan.Nm_Kec',
                'kelurahan.Nm_Kel',
                'lingkungan.Nm_Lingkungan',
                [
                    'header' => 'Asal Usulan',
                    'format' => 'html',
                    'value' => function ($model) {
                        if (isset($model->lingkungan->Nm_Lingkungan) AND isset($model->kelurahan->Nm_Kel)) {
                            return '<strong>'.$model->lingkungan->Nm_Lingkungan.", Kel.".$model->kelurahan->Nm_Kel.", Kec.".$model->kecamatan->Nm_Kec.'</strong>';
                        }
                        else if (!isset($model->lingkungan->Nm_Lingkungan) AND isset($model->kelurahan->Nm_Kel)) {
                            return '<strong>'."Kel.".$model->kelurahan->Nm_Kel.", Kec.".$model->kecamatan->Nm_Kec.'</strong>';
                        }
                        else if (!isset($model->lingkungan->Nm_Lingkungan) AND !isset($model->kelurahan->Nm_Kel)) {
                            return '<strong>'."Kec.".$val->kecamatan->Nm_Kec.'</strong>';
                        }
                    },
                ],
                [
                    'format' => 'html',
                    'header' => 'Detail Lokasi',
                    'value' => function ($model) {
                        if (!isset($model->Detail_Lokasi) OR $model->Detail_Lokasi == '' OR empty($model->Detail_Lokasi)) {
                            return '-';
                        }
                        else {
                            if ($model->Latitute == NULL OR !isset($model->Latitute) OR empty($model->Latitute) OR $model->Latitute == '') 
                            {
                                return $model->Detail_Lokasi.'';
                            }
                            else {
                                return '<p>'.$model->Detail_Lokasi.'</p>'
                                    .'<a href="https://www.google.com/maps/@'.$model->Latitute.','.$model->Longitude.',17z" target="_blank"><span class="label label-info"><i class="fa fa-map-marker"></i>Peta Lokasi</span></a>';
                            }
                        }
                    },
                ],
                [
                    'header' => 'Usulan',
                    'value' => 'Jenis_Usulan',
                ],
                [
                    'header' => 'Permasalahan',
                    'value' => 'Nm_Permasalahan',
                ],
                // [
                //  'header' => 'Usulan',
                //  'format' => 'html',
                //  'value' => function ($model) {
       //               return '<span class="label label-success">Usulan</span>'.'<br/>'.$model->Jenis_Usulan
       //                       .'<br/>'.'<br/>'
       //                       .'<span class="label label-danger">Permasalahan</span>'.'<br/>'.$model->Nm_Permasalahan;
       //           },
                // ],
                [
                    'header' => 'Jumlah/Vol',
                    'value' => function ($model) {
                        return $model->Jumlah.' '.$model->satuan->Uraian;
                    },  
                ],
                // [
                //  'header' => 'Dokumen',
                //  'format' => 'html',
                //  'value' => function ($model) {
                //      if (isset($model->taForumLingkungan->Kd_Ta_Forum_Lingkungan)) {

                //          $foto = $model->taForumLingkungan->getTaUsulanLingkunganMedia()->all();

                //          foreach ($foto as $value) {
       //                          $nama_file = $value->Kd_Media;
       //                          $url = "index.php?r=dashboard/lihat-file&nama_file=".$nama_file;
       //                      }
       //                      return $nama_file;
                //      }
                //      else {
                //          return '';
                //      }
       //           },  
                // ],
            ]
        ])
    ?>
</div>  

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