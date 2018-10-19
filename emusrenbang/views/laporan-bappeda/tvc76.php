<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Penjelasan Program Pembangunan Daerah ";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header with-border">
     	<div class="col-md-1"></div><div class="col-md-10" align="center"><h3>Penjelasan Program Pembangunan Daerah </h3></div><div class="col-md-1"></div>
    	<br><br>
    	<div class="col-xs-12">
    		<table class="table table-bordered">
    			<thead>
                    <tr>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">No</p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">Prioritas Pembangunan</p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">Program/ Pembangunan</p></th>
	    				<th colspan="2"><p class="text-center">Kinerja</p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">OPD</p></th>
    				</tr>
                    <tr>
                        <th><p class="text-center">Indikator</p></th>
                        <th><p class="text-center">Target</p></th>
                    </tr>
    			</thead>
    			<tbody>
                    <?php foreach ($model as $programprio): 
                    
                     ?>

                    <tr>
                        <td></td>
                        <td> <?= $programprio->taRpjmdPrioritasPembangunanDaerah['Prioritas_Pembangunan_Daerah'] ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <?php 
                    $no=1;
                    $pemprio = $programprio->taPrograms;
                    foreach ($pemprio as $program) :
                    ?>

                    <tr>
                        <td> <?= $no++ ?></td>
                        <td></td>
                        <td><?= $program->refProgram['Ket_Program'] ?></td>
                        <td><?= $program['Tolak_Ukur'] ?> </td>
                        <td><?= $program['Target_Angka'] ?> </td>
                        <td><?= $program->refSubUnit['Nm_Sub_Unit'] ?></td>

                    </tr>
                    <?php endforeach?>
                    <?php endforeach; ?>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
