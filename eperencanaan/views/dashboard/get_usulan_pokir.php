<?php

use yii\helpers\Html;
use common\components\Helper;
use yii\grid\GridView;
use yii\widgets\LinkPager;

?>
                                <div class="box-body">
                                    <!-- <table class="table table-hover table-bordered"> -->
                                        <?= 
                                            GridView::widget([
                                            'dataProvider' => $dataProvider,
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                [
                                                    'label' => 'Permasalahan',
                                                    'value' => 'Nm_Permasalahan',
                                                ],
                                                [
                                                    'label' => 'Jenis Usulan',
                                                    'value' => 'Jenis_Usulan',
                                                ],
                                                [
                                                    'label' => 'BIDANG PEMBANGUNAN',
                                                    'value' => 'bidangPembangunan.Bidang_Pembangunan',
                                                ],
                                                [
                                                    'label' => 'PRIORITAS PEMBANGUNAN DAERAH',
                                                    'value' => 'rpjmd.Nm_Prioritas_Pembangunan_Kota',
                                                ],
                                                [
                                                    'label' => 'Jumlah',
                                                    'value' => 'Jumlah',
                                                ],
                                                [
                                                    'label' => 'Satuan',
                                                    'value' => 'satuan.Uraian',
                                                ],
                                                [
                                                    'label' => 'Daerah Pemilihan',
                                                    'value' => 'dapil.Nm_Dapil',
                                                ],                                            
                                            ],
                                            ]); 
                                        ?>
                                    
                                    <!-- </table> -->
                                </div>