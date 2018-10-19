
     <div class="box-header with-border">
        <div class="col-md-1"></div><div class="col-md-10" style="text-align:center;"><h3>Matriks Prioritas Pembangunan Daerah <br> Tahun Anggaran <?= date('Y') + 1 ?> </h3></div><div class="col-md-1"></div>
        <br>
        <div class="col-xs-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align:center;vertical-align:middle;">No </th>
                        <th style="text-align:center;vertical-align:middle;">Prioritas Pembangunan Daerah </th>
                        <th style="text-align:center;vertical-align:middle;">Sasaran </th>
                        <th style="text-align:center;vertical-align:middle;">Program </th>
                        <th style="text-align:center;vertical-align:middle;">OPD Pengelola </th>
                    </tr>

                    <tr>
                    <?php for($i=1;$i<=5;$i++): ?>
                        <td style="text-align:center;vertical-align:middle;">(<?= $i ?>)</td>
                    <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $no = 0; 
                    foreach ($data as $key => $value):
                        $no++;
                    ?>
                    <tr>
                        <td style="text-align:center;"><?= $no ?></td>
                        <td><?= $value->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah ?></td>
                        <td>
                        <?php foreach ($value->taRpjmdSasaranMany as $key1 => $value1): ?>
                            <p><?= $value1->Sasaran ?></p>
                        <?php endforeach; ?>
                        </td>
                        <td>
                        <?php foreach ($value->refProgramMany as $key1 => $value1): ?>
                            <p><?= $value1->program['Ket_Program'] ?></p>
                        <?php endforeach; ?>
                        </td>
                        <td>
                        <?php foreach ($value->refProgramMany as $key1 => $value1): ?>
                            <p><?= isset($value1->taProgram->refSubUnit->Nm_Sub_Unit) ? $value1->taProgram->refSubUnit->Nm_Sub_Unit : '' ?></p>
                        <?php endforeach; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>