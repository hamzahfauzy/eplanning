<?php
/* @var $this yii\web\View */
$filename = 'Data-'.Date('YmdGis').'-Satuan Harga.xls';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=".$filename);
$this->title = "Chart Akun SSH";

use common\models\RefSsh1;
use common\models\RefSsh2;
use common\models\RefSsh3;
use common\models\RefSsh4;
use common\models\RefSsh5;
use common\models\RefSsh;

echo '<table border="1" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Uraian</th>
                <th>Spesifikasi</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>';
    echo       '<tr>
                <td>'.$data1['Kd_Ssh1'].'</td>
                <td>'.$data1['Nm_Ssh1'].'</td>
            </tr>';
             foreach ($data1Duas as $data1Dua): 
        echo'<tr>
                <td> '.$data1Dua['Kd_Ssh1'].'.'.$data1Dua['Kd_Ssh2'].'</td>
                <td>'.$data1Dua['Nm_Ssh2'].'</td>
            </tr>';
                $data1Tigas = $data1Dua->refSsh3s;
                foreach ($data1Tigas as $data1Tiga):
                echo'<tr>
                        <td>'.$data1Tiga['Kd_Ssh1'].'.'.$data1Tiga['Kd_Ssh2'].'.'.$data1Tiga['Kd_Ssh3'].'</td>
                        <td>'.$data1Tiga['Nm_Ssh3'].'</td>
                    </tr>';
                    
                    $data1Empats = $data1Tiga->refSsh4s;
                    foreach ($data1Empats as $data1Empat):

                    echo'<tr>
                        <td>'.$data1Empat['Kd_Ssh1'].'.'.$data1Empat['Kd_Ssh2'].'.'.$data1Empat['Kd_Ssh3'].'.'.$data1Empat['Kd_Ssh4'].'</td>
                        <td>'.$data1Empat['Nm_Ssh4'].'</td>
                        </tr>';
                 
                        $data1Limas = $data1Empat->refSsh5s;
                        foreach ($data1Limas as $data1Lima):
                           
                        echo'<tr>
                            <td>'.$data1Lima['Kd_Ssh1'].'.'.$data1Lima['Kd_Ssh2'].'.'.$data1Lima['Kd_Ssh3'].'.'.$data1Lima['Kd_Ssh4'].'.'.$data1Lima['Kd_Ssh5'].'</td>
                            <td>'.$data1Lima['Nm_Ssh5'].'</td>
                            </tr>

                        <tr>
                            <td>
                            </td>
                        </tr>';
                        endforeach; 
                    endforeach;
                endforeach; 
            endforeach;
 echo       '</tbody>
 </table>';