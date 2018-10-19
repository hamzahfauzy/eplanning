
    <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Program dan Kegiatan Prioritas OPD <br> Tahun <?= date('Y') ?> </h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12"><h3>Nama OPD : <?= $skpd->Nm_Sub_Unit ?></h3></div>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Program</th>
                        <th style="text-align:center;">Kegiatan</th>
                       
                    </tr>

                     <tr>
                        <?php for($i=1;$i<=3;$i++): ?>
                        <td style="text-align:center;">(<?=$i?>)</td>
                        <?php endfor; ?>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($TaKegiatan as $kegiatan): ?>
                        
                   
                   <tr>
                        <td style="text-align: center;"> <?= $no++ ?> </th>
                        <td> <?= $kegiatan->program['Ket_Program']; ?> </th>
                        <td style=""> <?= $kegiatan['Ket_Kegiatan'];?> </th>

                   </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>