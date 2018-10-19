<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->title = 'Pantau Usulan';
$this->params['subtitle'] = 'Pantau Usulan';

//$this->params['breadcrumbs'][] ='';
//$this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-12">
            <div class="box-widget widget-module">
            <div class="widget-container">
                <div class=" widget-block">
                    
                     <div class="section-header">
                         <h2>Pantau Usulan  <small></small> </h2> 
                    </div>
                   <table class="table dt-table-export table-hover table-bordered matmix-dt bg-hc-border">
                    <thead>
                             <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Usulan Kegiatan
                        </th>
                        <th>
                            Jumlah/Vol
                        </th>
                        <th>
                            Lokasi
                        </th>
                        <th>
                            Pengusul
                        </th>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            Kelurahan
                        </th>
                        <th class="tc-center">
                            Kecamatan
                        </th>
                        <th>
                            SKPD
                        </th>
                    </tr>
                
                       </thead>
                    <tfoot>
                        <tr>
                        <th>
                            No
                        </th>
                        <th>
                            Usulan Kegiatan
                        </th>
                        <th>
                            Jumlah/Vol
                        </th>
                        <th>
                            Lokasi
                        </th>
                        <th>
                            Pengusul
                        </th>
                        <th>
                            Tanggal
                        </th>
                        <th >
                            Kelurahan
                        </th>
                        <th class="tc-center">
                            Kecamatan
                        </th>
                        <th>
                            SKPD
                        </th>
                    </tr>
                    </tfoot>
                    <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Pengadaan Gerobak SampaH
                            
                        </td>
                        <td>
                            13    Buah
                        </td>
                        <td>
                        Jl sekata
                        </td>
                        <td>
                        Kelurahan Fatululi  RT: 0 RW: 0 Kelurahan : FATULULI    - Kec : OEBOBO
                        </td>
                        <td>
                            2016-02-10
                        </td>
                        <td class="tc-center"> 
                            <label class="label label-info">Diterima</label>
                        </td>
                        <td class="tc-center">
                            <label class="label label-danger">Ditolak</label>
                        </td>
                        <td class="tc-center">
                            
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Pembangunan Jalan Hotmix
                            
                        </td>
                        <td>
                            1000    m
                        </td>
                        <td>
                        Jl sekata
                        </td>
                        <td>
                        Kelurahan   RT: 19,27,28 RW: 0  Kelurahan : TDM - Kec : OEBOBO
                        </td>
                        <td>
                            2016-02-10
                        </td>
                        <td class="tc-center"> 
                            <label class="label label-info">Diterima</label>
                        </td>
                        <td class="tc-center">
                            <label class="label label-info">Diterima / Diubah</label>
                        </td>
                        <td class="tc-center">
                            <label class="label label-danger">Ditolak</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Pembangunan Aula Kantor Lurah
                            
                        </td>
                        <td>
                            1    Paket
                        </td>
                        <td>
                        Jl sekata
                        </td>
                        <td>
                        Kelurahan TDM   RT: 0 RW: 0 Kelurahan : TDM - Kec : OEBOBO
                        </td>
                        <td>
                            2016-02-10
                        </td>
                        <td class="tc-center"> 
                            <label class="label label-info">Diterima</label>
                        </td>
                        <td class="tc-center">
                            <label class="label label-info">Diterima</label>
                        </td>
                        <td class="tc-center">
                            <label class="label label-warning">Diproses</label>
                        </td>
                    </tr>
                    
                    </tbody>
                    </table>
    
    
                </div>
            </div>
        </div>
    </div>
    
  
</div>