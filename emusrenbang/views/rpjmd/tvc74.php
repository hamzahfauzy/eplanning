<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header with-border">
        <div class="box-header" align="center">
            <h3 class="box-title">Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan</h3>
        </div>
    	<div class="box-body">
    		<table class="table table-bordered">
    			<thead>
                    <tr>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">No</p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">Visi/ Misi</p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">Tujuan</p></th>
	    				<th rowspan="2" style="vertical-align: middle;"><p class="text-center">Sasaran</p></th>
    				</tr>
    			</thead>
    			<tbody>
                    <?php 
                        $i=1;
                        foreach ($data as $key => $value) :
                    ?>
    				<tr>
    					<td><p class="text-center"><?=$i++?></p></td>
                        <td>
                            <p><?=$value->Misi?></p>
                        </td>
                        <td>
                            <ul>
                                <?php foreach ($value->taRpjmdTujuans as $key1 => $value1): ?>
                                    <li><?=$value1->Tujuan?></li>
                                <?php endforeach; ?>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <?php foreach ($value->taRpjmdTujuans as $key1 => $value1): ?>
	                                <?php foreach ($value1->taRpjmdSasarans as $key2 => $value2): ?>
	                                    <li><?=$value2->Sasaran?></li>
	                                <?php endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        </td>
    				</tr>
                    <?php endforeach; ?>
    			</tbody>
    		</table>
    	</div>
    </div>
</div>
