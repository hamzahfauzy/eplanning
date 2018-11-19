
<?php
$no = 1;
foreach ($NASUsulan as $value) :
    ?>
    <tr><td><?php echo $no++; ?></td>

        <td><?php echo $value->Nm_Permasalahan; ?></td> 
        <td><?php echo $value->kelurahan->Nm_Kel ?></td> 
        <td><?php echo $value->rpjmd->Nm_Prioritas_Pembangunan_Kota; ?> </td>
        <td><!-- Usulan --> </td>
    <tr>

    <?php endforeach; ?>

<!--     <?php 
    echo LinkPager::widget([
    'pagination' => $pages, ]);
?> -->



