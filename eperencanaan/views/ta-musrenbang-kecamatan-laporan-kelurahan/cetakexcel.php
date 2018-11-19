<?php
$filename = 'Data-'.Date('YmdGis').'-Usulan_Kelurahan.xls';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=".$filename);
echo '<table border="1" width="100%">
         <thead>
             <tr>
                <th></th>
                <th> Digolongkan berdasarkan: </th>
             </tr>

            <tr>
                <th></th>
                <th>Kelurahan : '.$kelurahan.' </th>
            </tr> 

            <tr>
                <th></th>
                <th>Bidang Pembangunan : '.$bid_pem.'  </th>
            </tr>


            <tr></tr>

            <tr>   
                 <th>No</th>
                 <th>Kegiatan Prioritas</th>
                 <th>Kriteria 1</th>
                 <th>Kriteria 2</th>
                 <th>Kriteria 3</th>
                 <th>Kriteria 4</th>
                 <th>Kriteria 5</th>
                 <th>Kriteria 6</th>
                 <th>Kriteria 7</th>
                 <th>Kriteria 8</th>
                 <th>Total Skor</th>
             </tr>
         </thead>';

         $no = 1;
         foreach($NASUsulan as $value){
             echo '
                 <tr>
                     <td> '.$no++.' </td>
                     <td> <b>Permasalahan:</b>
                          <p>'.$value->Nm_Permasalahan.' </p>
                          <b>Usulan:</b>
                          <p> '.$value->Jenis_Usulan.' </p>
                          </td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                 </tr>
            ' ;
         }
     echo '</table>';
?>