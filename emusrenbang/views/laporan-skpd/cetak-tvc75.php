
<div class="box box-success">
    <div class="box-header">
         <h3 class="box-tilte" style="text-align: center;">Prioritas Pembangunan Daerah</h3>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="vertical-align: middle;text-align:center;">No</th>
                    <th style="vertical-align: middle;text-align:center;">Prioritas Pembanguan daerah (RKPD)</th>
                    <th style="vertical-align: middle;text-align:center;">Program Prioritas Tahun Rencana (RPJMD)<th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $i = 1;
                foreach ($model as $key => $value):
            ?>
                <?php foreach ($value->taRpjmdProgramPrioritass as $keys => $values): ?>
                    <tr>
                        <td style="vertical-align: middle;text-align:center;"><?= $i++ ?></td>
                        <td style="vertical-align: middle;"><?= $values->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah?></td>
                        <td><?= $values->refKamusProgram->Nm_Program ?> </td>
                    </tr>
                    
                <?php endforeach; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>