<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Nawacita */

$this->title = "Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan";
$this->params['breadcrumbs'][] = ['label' => 'Dokumen', 'url' => ['laporan-skpd/sub-unit']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success">
    <div class="box-header">
         <h3 class="box-tilte" style="text-align: center;">Hubungan Visi/Misi dan Tujuan/Sasaran Pembangunan</h3>
         <label>Nama OPD : <?= $subunit->Nm_Sub_Unit ?></label>
    </div>
	<div class="box-body">
		<table class="table table-bordered">
			<thead>
                <tr>
    				<th style="vertical-align: middle;"><p class="text-center">No</p></th>
    				<th style="vertical-align: middle;"><p class="text-center">Visi/ Misi</p></th>
    				<th style="vertical-align: middle;"><p class="text-center">Tujuan</p></th>
    				<th style="vertical-align: middle;"><p class="text-center">Sasaran</p></th>
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
                        <p><strong>Visi: </strong></p>
                        <ol>
                            <li><?=$value->Ur_Visi?></li>
                        </ol>
                        <p><strong>Misi: </strong></p>
                        <ol>
                        <?php foreach ($value->taMisis as $keys => $values) :?>
                            <li><?=$values->Ur_Misi?></li>
                        <?php endforeach; ?>
                        </ol>
                    </td>
                    <td>
                        <ol>
                            <?php foreach ($data as $key => $value): ?>
                                <?php foreach ($value->taMisis as $keys => $values): ?>
                                    <?php foreach ($values->taTujuans as $keyn => $valuen): ?>
                                        <li><?=$valuen->Ur_Tujuan?></li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ol>
                    </td>
                    <td>
                        <ol>
                            <?php foreach ($data as $key => $value): ?>
                                <?php foreach ($value->taMisis as $keys => $values): ?>
                                    <?php foreach ($values->taTujuans as $keyn => $valuen): ?>
                                        <?php foreach ($valuen->taSasarans as $keyns => $valuens): ?>
                                            <li><?=$valuens->Ur_Sasaran?></li>
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </ol>
                    </td>
				</tr>
                <?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
