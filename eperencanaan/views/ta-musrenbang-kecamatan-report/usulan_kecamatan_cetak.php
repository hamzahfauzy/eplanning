<?php

\moonland\phpexcel\Excel::export([
    'isMultipleSheet' => true, 
    'models' => [
        'Infrastruktur' => $pem_1, 
        'Kesehatan' => $pem_2,
        'Pendidikan' => $pem_3,
		'Pertanian' => $pem_4
    ], 
    'columns' => [
        'Infrastruktur' => [
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Asal_Usulan == 1) {
                        $asal_usulan = "Lingkungan";
                    }
                    else if ($model->Kd_Asal_Usulan == 2) {
                        $asal_usulan = "Kelurahan";
                    }
                    else if ($model->Kd_Asal_Usulan == 3) {
                        $asal_usulan = "Kecamatan";
                    }
                    else {
                        $asal_usulan = "Tidak Ditemukan";
                    }
                    return $asal_usulan;
                },
            ],
            'Nm_Permasalahan:text:Nama Permasalahan',
            'Jenis_Usulan:text:Usulan',
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Kel) $Nm_Kel = $model->kelurahan->Nm_Kel;
                    else $Nm_Kel = '';
                    
                    return $Nm_Kel;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Lingkungan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Lingkungan) $Nm_Lingkungan = $model->lingkungan->Nm_Lingkungan ;
                    else $Nm_Lingkungan = '';
                        
                    return $Nm_Lingkungan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Jalan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Jalan) $Nm_Jalan = $model->kdJalan->Nm_Jalan ;
                    else $Nm_Jalan = '';
                        
                    return $Nm_Jalan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Detail Lokasi',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Detail_Lokasi) $Detail_Lokasi = $model->Detail_Lokasi ;
                    else $Detail_Lokasi = '';
                        
                    return $Detail_Lokasi;
                },
            ],
            'Jumlah:text:Jumlah',
            [
                'attribute' => 'content',
                'header' => 'Satuan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->satuan->Uraian) $Nm_Satuan = $model->satuan->Uraian; 
                    else $Nm_Satuan = '';
                        
                    return $Nm_Satuan;
                },
            ],
            'Harga_Total:text:Harga Total',
            [
                'attribute' => 'content',
                'header' => 'SKPD Penanggungjawab',
                'format' => 'text',
                'value' => function($model) {
                    if(isset($model->Kd_Sub) && $model->Kd_Sub != 0 && $model->Kd_Sub != null ) $Nm_Skpd = $model->refSubUnit->Nm_Sub_Unit;
                    else $Nm_Skpd = '';
                        
                    return $Nm_Skpd;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Prioritas Pembangunan Daerah',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Prioritas_Pembangunan_Daerah)
                        $rpjmd_pilih = @$model->rpjmdx->Nm_Prioritas_Pembangunan_Kota;
                    else
                        $rpjmd_pilih = 'Non Prioritas';
                        
                    return $rpjmd_pilih;
                },
            ],

        ], 
        'Kesehatan' => [
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Asal_Usulan == 1) {
                        $asal_usulan = "Lingkungan";
                    }
                    else if ($model->Kd_Asal_Usulan == 2) {
                        $asal_usulan = "Kelurahan";
                    }
                    else if ($model->Kd_Asal_Usulan == 3) {
                        $asal_usulan = "Kecamatan";
                    }
                    else {
                        $asal_usulan = "Tidak Ditemukan";
                    }
                    return $asal_usulan;
                },
            ],
            'Nm_Permasalahan:text:Nama Permasalahan',
            'Jenis_Usulan:text:Usulan',
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Kel) $Nm_Kel = $model->kelurahan->Nm_Kel;
                    else $Nm_Kel = '';
                    
                    return $Nm_Kel;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Lingkungan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Lingkungan) $Nm_Lingkungan = $model->lingkungan->Nm_Lingkungan ;
                    else $Nm_Lingkungan = '';
                        
                    return $Nm_Lingkungan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Jalan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Jalan) $Nm_Jalan = $model->kdJalan->Nm_Jalan ;
                    else $Nm_Jalan = '';
                        
                    return $Nm_Jalan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Detail Lokasi',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Detail_Lokasi) $Detail_Lokasi = $model->Detail_Lokasi ;
                    else $Detail_Lokasi = '';
                        
                    return $Detail_Lokasi;
                },
            ],
            'Jumlah:text:Jumlah',
            [
                'attribute' => 'content',
                'header' => 'Satuan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->satuan->Uraian) $Nm_Satuan = $model->satuan->Uraian; 
                    else $Nm_Satuan = '';
                        
                    return $Nm_Satuan;
                },
            ],
            'Harga_Total:text:Harga Total',
            [
                'attribute' => 'content',
                'header' => 'OPD Penanggungjawab',
                'format' => 'text',
                'value' => function($model) {
                    if(isset($model->Kd_Sub) && $model->Kd_Sub != 0 && $model->Kd_Sub != null ) $Nm_Skpd = $model->refSubUnit->Nm_Sub_Unit;
                    else $Nm_Skpd = '';
                        
                    return $Nm_Skpd;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Prioritas Pembangunan Daerah',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Prioritas_Pembangunan_Daerah)
                        $rpjmd_pilih = @$model->rpjmdx->Nm_Prioritas_Pembangunan_Kota;
                    else
                        $rpjmd_pilih = 'Non Prioritas';
                        
                    return $rpjmd_pilih;
                },
            ],

        ],
        'Pendidikan' => [
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Asal_Usulan == 1) {
                        $asal_usulan = "Lingkungan";
                    }
                    else if ($model->Kd_Asal_Usulan == 2) {
                        $asal_usulan = "Kelurahan";
                    }
                    else if ($model->Kd_Asal_Usulan == 3) {
                        $asal_usulan = "Kecamatan";
                    }
                    else {
                        $asal_usulan = "Tidak Ditemukan";
                    }
                    return $asal_usulan;
                },
            ],
            'Nm_Permasalahan:text:Nama Permasalahan',
            'Jenis_Usulan:text:Usulan',
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Kel) $Nm_Kel = $model->kelurahan->Nm_Kel;
                    else $Nm_Kel = '';
                    
                    return $Nm_Kel;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Lingkungan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Lingkungan) $Nm_Lingkungan = $model->lingkungan->Nm_Lingkungan ;
                    else $Nm_Lingkungan = '';
                        
                    return $Nm_Lingkungan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Jalan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Jalan) $Nm_Jalan = $model->kdJalan->Nm_Jalan ;
                    else $Nm_Jalan = '';
                        
                    return $Nm_Jalan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Detail Lokasi',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Detail_Lokasi) $Detail_Lokasi = $model->Detail_Lokasi ;
                    else $Detail_Lokasi = '';
                        
                    return $Detail_Lokasi;
                },
            ],
            'Jumlah:text:Jumlah',
            [
                'attribute' => 'content',
                'header' => 'Satuan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->satuan->Uraian) $Nm_Satuan = $model->satuan->Uraian; 
                    else $Nm_Satuan = '';
                        
                    return $Nm_Satuan;
                },
            ],
            'Harga_Total:text:Harga Total',
            [
                'attribute' => 'content',
                'header' => 'SKPD Penanggungjawab',
                'format' => 'text',
                'value' => function($model) {
                    if(isset($model->Kd_Sub) && $model->Kd_Sub != 0 && $model->Kd_Sub != null ) $Nm_Skpd = $model->refSubUnit->Nm_Sub_Unit;
                    else $Nm_Skpd = '';
                        
                    return $Nm_Skpd;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Prioritas Pembangunan Daerah',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Prioritas_Pembangunan_Daerah)
                        $rpjmd_pilih = @$model->rpjmdx->Nm_Prioritas_Pembangunan_Kota;
                    else
                        $rpjmd_pilih = 'Non Prioritas';
                        
                    return $rpjmd_pilih;
                },
            ],

        ],
		'Pertanian' => [
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Asal_Usulan == 1) {
                        $asal_usulan = "Lingkungan";
                    }
                    else if ($model->Kd_Asal_Usulan == 2) {
                        $asal_usulan = "Kelurahan";
                    }
                    else if ($model->Kd_Asal_Usulan == 3) {
                        $asal_usulan = "Kecamatan";
                    }
                    else {
                        $asal_usulan = "Tidak Ditemukan";
                    }
                    return $asal_usulan;
                },
            ],
            'Nm_Permasalahan:text:Nama Permasalahan',
            'Jenis_Usulan:text:Usulan',
            [
                'attribute' => 'content',
                'header' => 'Nama Kelurahan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Kel) $Nm_Kel = $model->kelurahan->Nm_Kel;
                    else $Nm_Kel = '';
                    
                    return $Nm_Kel;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Lingkungan',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Lingkungan) $Nm_Lingkungan = $model->lingkungan->Nm_Lingkungan ;
                    else $Nm_Lingkungan = '';
                        
                    return $Nm_Lingkungan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Nama Jalan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Kd_Jalan) $Nm_Jalan = $model->kdJalan->Nm_Jalan ;
                    else $Nm_Jalan = '';
                        
                    return $Nm_Jalan;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Detail Lokasi',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->Detail_Lokasi) $Detail_Lokasi = $model->Detail_Lokasi ;
                    else $Detail_Lokasi = '';
                        
                    return $Detail_Lokasi;
                },
            ],
            'Jumlah:text:Jumlah',
            [
                'attribute' => 'content',
                'header' => 'Satuan',
                'format' => 'text',
                'value' => function($model) {
                    if ($model->satuan->Uraian) $Nm_Satuan = $model->satuan->Uraian; 
                    else $Nm_Satuan = '';
                        
                    return $Nm_Satuan;
                },
            ],
            'Harga_Total:text:Harga Total',
            [
                'attribute' => 'content',
                'header' => 'SKPD Penanggungjawab',
                'format' => 'text',
                'value' => function($model) {
                    if(isset($model->Kd_Sub) && $model->Kd_Sub != 0 && $model->Kd_Sub != null ) $Nm_Skpd = $model->refSubUnit->Nm_Sub_Unit;
                    else $Nm_Skpd = '';
                        
                    return $Nm_Skpd;
                },
            ],
            [
                'attribute' => 'content',
                'header' => 'Prioritas Pembangunan Daerah',
                'format' => 'text',
                'value' => function($model) {
                    if($model->Kd_Prioritas_Pembangunan_Daerah)
                        $rpjmd_pilih = @$model->rpjmdx->Nm_Prioritas_Pembangunan_Kota;
                    else
                        $rpjmd_pilih = 'Non Prioritas';
                        
                    return $rpjmd_pilih;
                },
            ],

        ]
    ],
]);
?>