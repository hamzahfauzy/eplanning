<?php
  $filename = 'Data-'.Date('YmdGis').'-PraRKA.xls';
  header("Content-type: application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=".$filename);
?>

<table border="1" width="100%">

    <tr>
        <th rowspan="2" style="text-align: center;">No</th>
        <th rowspan="2" style="text-align: center;">OPD</th>
        <th rowspan="2" style="text-align: center;">Program</th>
        <th colspan="2" style="text-align: center;">Kinerja</th>
        <th rowspan="2" style="text-align: center;">Pagu Indikatif</th>
    </tr>
    <tr>
        <td style="text-align: center;">Indikator</td>
        <td style="text-align: center;">Target</td>
    </tr>
    <!-- <tr>
        <td style="text-align: center;">1</td>
        <td style="text-align: center;">2</td>
        <td style="text-align: center;">3</td>
        <td style="text-align: center;">4</td>
        <td style="text-align: center;">5</td>
        <td style="text-align: center;">6</td>
    </tr> -->

    <?php 
        $no = 0; 
        foreach ($model as $val) :
            $no++;
            ?>
                <tr>
                <td><?= $no ?></td>
                <td><?= $val->refSubUnit->Nm_Sub_Unit ?></td>
                <td>
                    <?php
                        if (isset($val->refProgram->Ket_Program)) {
                            echo @$val->refProgram->Ket_Program;
                        }
                    ?>      
                </td>
                <td></td>
                <td></td>
                <td>
                    <?php  
                        if (isset($val->pagu->pagu)) {
                            echo @$val->pagu->pagu;
                        }
                    ?>
                </td>
                </tr>
            <?php
        endforeach ; // akhir model
    ?>

</table>    