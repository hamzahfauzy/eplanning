<?php

use yii\helpers\Html;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

$this->registerJsFile(
        '@web/js/sistem/menu.js', ['depends' => [\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
        '@web/css/sistem/menu.css', ['depends' => [\yii\web\JqueryAsset::className()]]
);

//-------Pengelompokan menu--------//
$menus = [];  //deklarasi array menu
//syarat dengan pengecekan terhadap rules
if (Yii::$app->levelcomponent->isRoles('Operator_Lingkungan') || Yii::$app->levelcomponent->isRoles('Operator')) { //rembuk warga
    $menus = menu_lingkungan();
} else if (Yii::$app->levelcomponent->isRoles('Operator_Kelurahan')) { //musrenbang kelurahan
    $menus = menu_kelurahan();
} else if (Yii::$app->levelcomponent->isRoles('Operator_Kecamatan')) { //musrenbang kecamatan
    $menus = menu_kecamatan();
} else if (Yii::$app->levelcomponent->isRoles('Operator_Skpd') || Yii::$app->levelcomponent->isRoles('Admin_Skpd')) { //musrenbang kecamatan
    $menus = menu_skpd();
} else if (Yii::$app->levelcomponent->isRoles('Operator_Pokir')) { //musrenbang kecamatan
    $menus = menu_pokir();
}
// else if (Yii::$app->levelcomponent->isRoles('Admin_Skpd')) {
//     echo "Admin SKPD";
// }
else if (Yii::$app->levelcomponent->isRoles('Admin_Sistem') || Yii::$app->levelcomponent->isRoles('Operator_Bappeda')) {
    $menus = menu_sistem();
} else {
    echo "";
}

//$menus [] = ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
/**
  echo Nav::widget(
  [
  'options' => ['class' => 'nav navbar-nav'],
  'encodeLabels' => false,
  'items' => $menus,
  //    'options' => ['class' =>'nav-pills'], // set this to nav-tab to get tab-styled navigation
  ]);
 * 
 */
NavBar::begin([
    'brandLabel' => false,
    'options' => [
        'class' => 'navigator',
    ]
]);
echo Nav::widget([
    'items' => $menus,
    'options' => ['class' => 'navbar-nav'],
]);

echo Nav::widget([
    'items' => [
        ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
    ],
    'options' => ['class' => 'navbar-nav  navbar-right'],
]);
NavBar::end();

//-------Akhir Pengelompokan menu--------//

function menu_lingkungan() {
    $menus = []; //deklarasi array untuk menampung menu

    $menus[] = ['label' => 'Beranda', 'url' => ['/lingkungan/index']]; //menu beranda

    $acara = Yii::$app->levelcomponent->getWaktuAcara(); //pengecekan tabel ta forum lingkungan acara

    if ($acara == 3) { //cek apakah rembuk warga sudah selesai
        $menus[] = ['label' => 'Rekapitulasi Usulan', 'url' => ['/lingkungan/rekapitulasi']];
        $menus[] = ['label' => 'Dokumen', 'url' => ['/lingkungan/dokumen']];
    }
    if ($acara == 2) { //cek apakah sudah mulai remuk warga
        $menus[] = ['label' => 'Tambah Usulan', 'url' => ['/lingkungan/tambah']];
        $menus[] = ['label' => 'Rekapitulasi Usulan', 'url' => ['/lingkungan/rekapitulasi']];
        $menus[] = ['label' => 'Dokumen', 'url' => ['/lingkungan/dokumen']];
    } else {
        
    }

    return $menus;
}

function menu_kelurahan() {
    $menus = []; //deklarasi array untuk menampung menu

    $menus[] = ['label' => 'Beranda', 'url' => ['/ta-musrenbang-kelurahan/index']]; //menu beranda

    $acara = Yii::$app->levelcomponent->getWaktuAcara(); //pengecekan tabel ta forum lingkungan acara

    if ($acara == 0 || $acara == 1) { //belum memulai musrenbang kelurahan
        //$menus[] = ['label' => 'Cetak Usulan Dusun/Lingkungan', 'url' => ['/ta-musrenbang-kelurahan-report/index']];
        $menus[] = ['label' => 'Pantau Usulan', 'url' => ['/ta-musrenbang-kelurahan-explorer/index']];
    } elseif ($acara == 2) { //sudah mulai musrenbang kelurahan
        //$menus[] = ['label' => 'Cetak Usulan Lingkungan', 'url' => ['/ta-musrenbang-kelurahan-report/index']];
        $menus[] = ['label' => 'Pantau Usulan', 'url' => ['/ta-musrenbang-kelurahan-explorer/index']];
        $menus[] = ['label' => 'Dokumen',
            'options' => ['data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Untuk melengkapi Dokumen Musrenbang', 'class' => 'myTooltipClass'],
            'url' => ['/ta-musrenbang-kelurahan/dokumen']];

        $status_bahas = Yii::$app->levelcomponent->getStatusPembahasan(); //cek status pembahasan

        if ($status_bahas) { //apabila semua usulan sudah di bahas
            $menus[] = ['label' => 'Kompilasi',
                'options' => ['data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
                    'title' => 'Untuk melakukan pengelompokan usulan',
                    'class' => 'myTooltipClass'],
                'url' => ['/ta-musrenbang-kelurahan/kompilasi']
            ];


            $menus[] = [
                'label' => 'Usulkan Ke Kecamatan',
                'options' => ['data-toggle' => 'tooltip',
                    'data-placement' => 'bottom',
                    'title' => 'Pastikan seluruh usulan sudah dikompilasi!',
                    'class' => 'myTooltipClass'],
                'url' => ['/ta-musrenbang-kelurahan/rekapitulasi']
            ];
        } else { //apabila ada usulan yang belum di bahas
            $menus[] = [
                'label' => 'Rekapitulasi Usulan',// Dusun/Lingkungan',
                'options' => ['data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Untuk melakukan verifikasi usulan', 'class' => 'myTooltipClass'],
                //'url' => ['/ta-kelurahan-verifikasi-usulan-lingkungan/usulan-lingkungan']
                'url' => ['/ta-kelurahan-verifikasi-usulan-lingkungan/usulan-lingkungan']
            ];

            $menus[] = ['label' => 'Tambah Usulan Desa/Kelurahan',
                'options' => ['data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Untuk mengakomodir usulan dusun/lingkungan yang dirasa perlu', 'class' => 'myTooltipClass'],
                'url' => ['/ta-musrenbang-kelurahan/create']];
        }
    } else {
        $menus[] = ['label' => 'Usulkan Ke Kecamatan',
            'options' => ['data-toggle' => 'tooltip',
                'data-placement' => 'bottom',
                'title' => 'Pastikan seluruh usulan sudah dikompilasi!',
                'class' => 'myTooltipClass'],
            'url' => ['/ta-musrenbang-kelurahan/rekapitulasi']
        ];
        //$menus[] = ['label' => 'Cetak Usulan Desa/Kelurahan', 'url' => ['/ta-musrenbang-kelurahan-report/pasca']];
        $menus[] = ['label' => 'Pantau Usulan', 'url' => ['/ta-musrenbang-kelurahan-explorer/index']];
        $menus[] = [
            'label' => 'Dokumen',
            'options' => ['data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Untuk melengkapi Dokumen Musrenbang', 'class' => 'myTooltipClass'],
            'url' => ['/ta-musrenbang-kelurahan/dokumen']
        ];
    }

    return $menus;
}

function menu_kecamatan() {
    $menus = []; //deklarasi array untuk menampung menu

    $menus[] = ['label' => 'Beranda', 'url' => ['/ta-musrenbang-kecamatan/index']]; //menu beranda

    $acara = Yii::$app->levelcomponent->getWaktuAcara(); //pengecekan tabel ta forum lingkungan acara


    if ($acara == 0 || $acara == 1) { //belum memulai musrenbang kecamatan
        $menus[] = ['label' => 'Pantau Usulan', 'url' => ['/ta-musrenbang-kecamatan-explorer/index']];
        $menus[] = ['label' => 'Cetak Usulan Desa/Kelurahan', 'url' => ['/ta-musrenbang-kecamatan-report/index']];
    } elseif ($acara == 2) { //sudah mulai musrenbang kecamatan

        $menus[] = [
            'label' => 'Usulan Masuk',
            'items' => [
                ['label' => 'Cetak Usulan Desa/Kelurahan', 'url' => ['/ta-musrenbang-kecamatan-report/index']],
                ['label' => 'Pantau Usulan', 'url' => ['/ta-musrenbang-kecamatan-explorer/index']]
            ],
        ];

        $menus[] = [
            'label' => 'Usulan Kecamatan',
            'items' => [
                ['label' => 'Tambah Usulan', 'url' => ['/musrenbang-kecamatan/create']],
                ['label' => 'Usulan Kecamatan', 'url' => ['/ta-musrenbang-kecamatan-report/usulan-kecamatan']],
            ],
        ];

        $menus[] = ['label' => 'Skoring', 'url' => ['/musrenbang-kecamatan/skoring']];

        $menus[] = [
            'label' => 'Hasil Skoring',
            'items' => [
                ['label' => 'Usulan Prioritas', 'url' => ['/ta-musrenbang-kecamatan-report/usulan-prioritas']],
                ['label' => 'Usulan Cadangan', 'url' => ['/ta-musrenbang-kecamatan-report/usulan-cadangan']],
            ],
        ];

        $menus[] = ['label' => 'Dokumen',
            'options' => ['data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Untuk melengkapi Dokumen Musrenbang', 'class' => 'myTooltipClass'],
            'url' => ['/ta-musrenbang-kecamatan/dokumen']];

    } else { // SElesai musrenbang kecamatan
        $menus[] = ['label' => 'Usulan Prioritas', 'url' => ['/ta-musrenbang-kecamatan-report/usulan-prioritas']];
        $menus[] = ['label' => 'Usulan Cadangan', 'url' => ['/ta-musrenbang-kecamatan-report/usulan-cadangan']];
        $menus[] = ['label' => 'Usulan Kecamatan', 'url' => ['/ta-musrenbang-kecamatan-report/usulan-kecamatan']];
        $menus[] = ['label' => 'Pantau Usulan', 'url' => ['/ta-musrenbang-kecamatan-explorer/index']];
        $menus[] = ['label' => 'Dokumen',
            'options' => ['data-toggle' => 'tooltip', 'data-placement' => 'bottom', 'title' => 'Untuk melengkapi Dokumen Musrenbang', 'class' => 'myTooltipClass'],
            'url' => ['/ta-musrenbang-kecamatan/dokumen']];
    }
    return $menus;
}

function menu_skpd() {
    $menus = []; //deklarasi array untuk menampung menu

    $menus[] = ['label' => 'Beranda', 'url' => ['/musrenbang-skpd/index']]; //menu beranda
	
	$acara = Yii::$app->levelcomponent->getWaktuOpd();
	
    if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) { //jika operator akan memiliki menu sesuai musrenbang skpd
    }

	if ($acara == 0 || $acara == 1) { //belum memulai musrenbang kecamatan
		$menus[] = [
            'label' => 'Usulan Masuk',
			'items' => [
                ['label' => 'Musrenbang Kecamatan', 'url' => ['/musrenbang-skpd/kecamatan-masuk']],
                ['label' => 'Pokir', 'url' => ['/musrenbang-skpd/pokir-masuk']],
            ],
        ];
    } elseif ($acara == 2) { //sudah mulai musrenbang kecamatan

        $menus[] = [
            'label' => 'Verifikasi Usulan Masuk',
			'items' => [
                ['label' => 'Musrenbang Kecamatan', 'url' => ['/musrenbang-skpd/kecamatan-masuk']],
                ['label' => 'Pokir', 'url' => ['/musrenbang-skpd/pokir-masuk']],
            ],
        ];

        $menus[] = ['label' => 'Dokumen', 'url' => ['/musrenbang-skpd/dokumen']];

    } else { // SElesai musrenbang kecamatan

        $menus[] = ['label' => 'Dokumen', 'url' => ['/musrenbang-skpd/dokumen']];
        $menus[] = ['label' => 'Hasil Forum OPD', 'url' => ['/musrenbang-skpd/hasil']];
    }
	
    if (Yii::$app->levelcomponent->isRoles('Admin_Skpd')) { //jika admin
        $menus[] = [
            'label' => 'Rencana Strategis',
            'items' => [
                ['label' => 'Visi', 'url' => ['/ta-sub-unit/index']],
                ['label' => 'Misi', 'url' => ['/ta-misi/index']],
                ['label' => 'Tujuan', 'url' => ['/ta-tujuan/index']],
                ['label' => 'Sasaran', 'url' => ['/ta-sasaran/index']],
                ['label' => 'Fungsi', 'url' => ['/ta-fungsi/index']],
            ],
        ];
        $menus[] = ['label' => 'Program Kegiatan', 'url' => ['/ta-kegiatan/index']];

        $menus[] = [
            'label' => 'Cetak',
            'items' => [
                ['label' => 'Renja', 'url' => ['/ta-sub-unit/index']],
                ['label' => 'Renstra', 'url' => ['/ta-sub-unit/index']],
            ],
        ];
    }

    // Nav::widget([
    //     'menus' => $menus,
    //     ]);
    return $menus;
}

function menu_sistem() {
    $menus = []; //deklarasi array untuk menampung menu

    $menus[] = ['label' => 'Beranda', 'url' => ['musrenbang-kecamatan/index']]; //menu beranda

    $acara = Yii::$app->levelcomponent->getWaktuAcara(); //pengecekan tabel ta forum lingkungan acara

    if ($acara == 0 || $acara == 1) { //belum memulai musrenbang kelurahan
    } elseif ($acara == 2) { //sudah mulai musrenbang kelurahan
        $status_bahas = Yii::$app->levelcomponent->getStatusPembahasan(); //cek status pembahasan
        if ($status_bahas) { //apabila semua usulan sudah di bahas
        } else { //apabila ada usulan yang belum di bahas
        }
    } else {
        
    }

    return $menus;
}

function menu_pokir() {


    $menus = []; //deklarasi array untuk menampung menu

    $menus[] = ['label' => 'Beranda', 'url' => ['/pokir/index']]; //menu beranda

    $acara = Yii::$app->levelcomponent->getPokirAcara(); //pengecekan tabel ta forum lingkungan acara
    //cek apakah rembuk warga sudah selesai


    if ($acara == 3) { //cek apakah rembuk warga sudah selesai
        $menus[] = ['label' => 'Rekapitulasi Usulan', 'url' => ['/pokir/rekapitulasi']];
        $menus[] = ['label' => 'Dokumen', 'url' => ['/pokir/dokumen']];
    }
    if ($acara == 2) { //cek apakah sudah mulai remuk warga
        $menus[] = ['label' => 'Tambah Usulan', 'url' => ['/pokir/create']];
        $menus[] = ['label' => 'Rekapitulasi Usulan', 'url' => ['/pokir/rekapitulasi']];
        $menus[] = ['label' => 'Dokumen', 'url' => ['/pokir/dokumen']];
    } else {
        
    }

    
    // if ($acara  == 3) { //cek apakah sudah mulai remuk warga
    //     $menus[] = ['label' => 'Tambah Usulan', 'url' => ['/pokir/create']];
    //     $menus[] = ['label' => 'Rekapitulasi Usulan', 'url' => ['/pokir/rekapitulasi']];
    //     $menus[] = ['label' => 'Dokumen', 'url' => ['/pokir/dokumen']];
    // } else {
        
    // }
     // $menus[] = ['label' => 'Tambah Usulan', 'url' => ['/pokir/create']];
    // $menus[] = ['label' => 'Rekapitulasi Usulan', 'url' => ['/pokir/rekapitulasi']];
    // $menus[] = ['label' => 'Dokumen', 'url' => ['/pokir/dokumen']];
        
    // if ($acara != 0) { //cek apakah sudah mulai remuk warga
    //    $menus[] = ['label' => 'Rekapitulasi Usulan', 'url' => ['/pokir/rekapitulasi']];
    //    $menus[] = ['label' => 'Dokumen', 'url' => ['/pokir/dokumen']];
   // } else {
   //  // $menus[] = ['label' => 'Laporan', 'url' => ['/pokir/laporan']];
   //  // $menus[] = ['label' => 'Laporan Pokir', 'url' => ['/pokir/laporan-pokir']];
   // }

    return $menus;
}

?>
