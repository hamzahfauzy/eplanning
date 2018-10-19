<?php
    $filename = 'Data-'.Date('YmdGis').'-Laporan Skoring.xls';
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=".$filename);
?>
<table border="1" width="100%">
    <thead>
        <tr>   
            
            <th>Kegiatan Prioritas </th>
            <th>Prioritas Kota </th>

        </tr>
    </thead>

    <tbody>
        <tr>

                    <th></th>
                    <th></th>

            
        </tr>
    </tbody>
</table>