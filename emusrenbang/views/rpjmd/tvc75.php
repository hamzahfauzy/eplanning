<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Prioritas Pembangunan Daerah";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="box-header" align="center">
            <h3 class="box-title">Prioritas Pembangunan Daerah</h3>
        </div>
    	<div class="box-body">
    		<table class="table table-bordered">
    			<thead>
                    <tr>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">No</p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">Program Prioritas Tahun Rencana (RPJMD) </p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">Prioritas Pembanguan daerah (RKPD)</p></th>
	    			</tr>
    			</thead>
    			<tbody>
                <?php 
                    $i=1;
                    foreach ($data as $key => $value):
                ?>
                    <tr>
                        <td><p class="text-center"><?= $i++ ?></p></td>
                        <td><p>P<?= $value->No_Prioritas ?></p></td>
                        <td><p><?= isset($value->taRpjmdPrioritasPembangunanDaerah) ? $value->taRpjmdPrioritasPembangunanDaerah->Prioritas_Pembangunan_Daerah : '' ?></p></td>
                    </tr>
                <?php endforeach; ?>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
