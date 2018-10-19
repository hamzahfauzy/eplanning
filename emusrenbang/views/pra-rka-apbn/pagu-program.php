<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\TaPaguSubUnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pra RKA';
$this->params['breadcrumbs'][] = "Program Kegiatan";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title"><?= $this->title ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<table class="table table-bordered">
                    <thead>
                        <th>No</th>
                        <th>Urusan</th>
                        <th>Bidang</th>
                        <th>Unit</th>
                        <th>Sub Unit</th>
                        <th>Pagu</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0; 
                        $uang = 0;
                        foreach ($data as $value) {
                            $i++;
                            $uang+=$value->pagu;
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td><?=$value->urusan->Nm_Urusan?></td>
                            <td><?=$value->bidang->Nm_Bidang?></td>
                            <td><?=$value->unit->Nm_Unit?></td>
                            <td><?=$value->sub_unit->Nm_Sub_Unit?></td>
                            <td><?=number_format($value->pagu,0,',','.')?></td>
                        </tr>
                        <?php }
                        ?>
                        <hr>
                        <tr>
                            <td rowspan="2" colspan="5"></td>
                            <th>Total :</th>
                        </tr>
                        <tr>
                            <td><?=number_format($uang,0,',','.')?></td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
