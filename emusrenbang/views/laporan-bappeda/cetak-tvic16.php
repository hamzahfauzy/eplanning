<div class="col-md-1"></div>
<div class="col-md-10" style="text-align:center;"><h3>Kajian Usulan Program dan Kegiatan dari Masyarakat Tahun <?= $tahun ?> <br><?= $kelompok['Kab'] ?> </h3></div>
<div class="col-md-1"></div>
<div class="col-xs-12"><h4>OPD : <?= $subunit['Nm_Sub_Unit'] ?></h4></div>
<table class="table table-striped table-bordered" id="sample_1">
    <caption class="headerFox text-center">
        
    </caption>
    <thead>
    <tr>
        <th  class="vcenter text-center" rowspan="2">No</th>
        <th  class="vcenter text-center" rowspan="2">Program/ Kegiatan</th>
        <th  class="vcenter text-center" colspan="4">Lokasi</th>
        <th  class="vcenter text-center" rowspan="2">Indikator Kinerja</th>
        <th  class="vcenter text-center" rowspan="2">Besaran/ Volume</th>
        <th  class="vcenter text-center" rowspan="2">Pagu</th>
    </tr>
    <tr>
        <th class="vcenter text-center">Kecamatan</th>
        <th class="vcenter text-center">Kelurahan</th>
        <th class="vcenter text-center">Lingkungan</th>
        <th class="vcenter text-center">Jalan</th>
    </tr>

    <tr>
        <th class="text-center">(1)</th>
        <th class="text-center">(2)</th>
        <th class="text-center">(3)</th>
        <th class="text-center">(4)</th>
        <th class="text-center">(5)</th>
        <th class="text-center">(6)</th>
        <th class="text-center">(7)</th>
        <th class="text-center">(8)</th>
        <th class="text-center">(9)</th>

    </tr>
    </thead>
    <tbody>
            
    <?php
     $no=1;
     foreach ($datausulan as $usulan): ?>
    <tr>    
    <td><?= $no++ ?></td>
    <td><?= $usulan['Jenis_Usulan']?> </td>
    <td><?= $usulan->kecamatan['Nm_Kec'] ?></td>
    <td><?= $usulan->kelurahan['Nm_Kel']?></td>
    <td><?= $usulan->lingkungan['Nm_Lingkungan']?></td>
    <td><?= $usulan->kdJalan['Nm_Jalan']?></td>
    <td><?= $usulan['Nm_Permasalahan'] ?></td>
    <td><?= $usulan['Jumlah']?> <?= $usulan->satuan['Uraian'] ?></td>
    <td><?= number_format($usulan['Harga_Total'],0, ',', '.') ?></td>
    </tr>

    <?php endforeach;?>
    </tbody>
</table>