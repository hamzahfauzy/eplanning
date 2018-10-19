<?php

namespace eperencanaan\controllers;

use common\models\RefKelurahan;
use common\models\RefBidangPembangunan;
use yii\helpers\ArrayHelper;
use common\models\TaMusrenbangKelurahan;

class TaMusrenbangKecamatanLaporanKelurahanController extends \yii\web\Controller {

    public function ZULAsal() {
        $ZULkelompok = \Yii::$app->levelcomponent->getKelompok();
        return [
            'Kd_Prov' => $ZULkelompok->Kd_Prov,
            'Kd_Kab' => $ZULkelompok->Kd_Kab,
            'Kd_Kec' => $ZULkelompok->Kd_Kec,
            // 'Kd_Kel' => $ZULkelompok->Kd_Kel,
            // 'Kd_Urut' => $ZULkelompok->Kd_Urut,
        ];
    }

     public function actionIndex() {
        $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');

        if ($NASModel->load(\Yii::$app->request->post())) {
            $NASUsulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                     ->where($this->ZULAsal());

            if ($NASModel->kelurahan != 0){
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
            }
            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' => $NASModel->bid_pem]);
            }
            if($NASModel->kata_kunci !=0){
                $NASUsulan->andWhere(['or', ['like','Nm_Permasalahan', $NASModel->kata_kunci],
                    ['like', 'Jenis_Usulan',$NASModel->kata_kunci]]);
            }         
        
           //   $NASUsulan->all();
           // print_r($NASUsulan->all());exit;

        return $this->renderPartial('lihat', [
                'NASUsulan' => $NASUsulan->all()
                ]);
        }  

        $NASKelurahan = ArrayHelper::map(RefKelurahan::find()
                ->where($this->ZULAsal())
                ->all(),'Kd_Urut', 'Nm_Kel');

        array_splice($NASKelurahan, 0, 0, ['0' => 'Tidak Memilih']);

        $ZUL_bid_pem = ArrayHelper::map(RefBidangPembangunan::find()
                ->all(), 'Kd_Pem', 'Bidang_Pembangunan');
        array_splice($ZUL_bid_pem, 0, 0, ['0' => 'Tidak Memilih']);
        
        return $this->render('index', [
                    'model' => $NASModel,
                    'NASKelurahan' => $NASKelurahan,
                    'ZUL_bid_pem' => $ZUL_bid_pem 
        ]);
    }
    

    
    public function actionCetak(){


    $NASModel = new \yii\base\DynamicModel([
            'kelurahan', 'bid_pem', 'kata_kunci'
        ]);
        $kelurahan = "-";
        $bid_pem = "-";
        $NASModel->addRule(['kelurahan', 'bid_pem'], 'integer')
                 ->addRule(['kata_kunci'], 'string');
        if($NASModel->load(\Yii::$app->request->post())){
            $NASUsulan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                    ->where($this->ZULAsal());

        
            if ($NASModel->kelurahan !=0) {
                $NASUsulan->andWhere(['Kd_Urut_Kel' => $NASModel->kelurahan]);
                $kelurahan = RefKelurahan::find()
                        ->where($this->ZULAsal())
                        ->andWhere(['Kd_Urut' => $NASModel->kelurahan])
                        ->one()->Nm_Kel;
            }

            if ($NASModel->bid_pem !=0){
                $NASUsulan->andWhere(['Kd_Pem' =>$NASModel->bid_pem]);
                $bid_pem = RefBidangPembangunan::find()
                        ->where(['Kd_Pem'=> $NASModel->bid_pem])
                        ->one()->Bidang_Pembangunan;

            }
            // if ($NASModel->kata_kunci != ''){
            //     $NASUsulan->andWhere(['or', ['like', 'Nm_Permasalahan', $NASModel->kata_kunci],
            //         ['like', 'Jenis_Usulan', $NASModel->kata_kunci]]);
                    
            // }

          return $this->renderPartial('cetakexcel', [
                'NASUsulan' => $NASUsulan->all(),
                'kelurahan' => $kelurahan,
                'bid_pem' => $bid_pem
                ]);

        }

    }

}

        // \moonland\phpexcel\Excel::widget([
        //     'models' => $NASUsulan->all(),
        //     'mode' => 'export', //default value as 'export'
        //     'columns' => ['Kd_Urut_Kel','Nm_Permasalahan'], //without header working, because the header will be get label from attribute label. 
        //     'headers' => ['Kelurahan' => 'Kelurahan','column2' => 'Permasalahan'], 
        // ]);

        //     $pdf = new \kartik\mpdf\Pdf([
        //     'mode' => \kartik\mpdf\Pdf::MODE_UTF8, // leaner size using standard fonts
        //     'format' => \kartik\mpdf\Pdf::FORMAT_FOLIO,
        //     'orientation' => \kartik\mpdf\Pdf::ORIENT_LANDSCAPE,
        //     'content' => $this->renderPartial('print', [
        //         'NASUsulan' => $NASUsulan->all(),
        //         'kelurahan' => $kelurahan,
        //         'bid_pem' => $bid_pem,
        //         'kata_kunci' => $NASModel->kata_kunci,
        //         'rpjmd' => \eperencanaan\models\RefRPJMD::find()->all()]),
        //     'options' => [
        //         'title' => 'Usulan Kelurahan',
        //     //'subject' => 'Generating PDF files via yii2-mpdf extension has never been easy'
        //     ],
        //     'methods' => [
        //         'SetHeader' => ['Dicetak dari: Sistem e-Perencanaan '.$this->getKota().'||Dicetak tanggal: ' . 
        //             \Yii::$app->zultanggal->ZULgethari(date('N')) .', '.(date('j')).' '.
        //             \Yii::$app->zultanggal->ZULgetbulan(date('n')) .' '.(date('Y')).'/'.
        //             (date('H:i:s'))],
        //         'SetFooter' => ['|Halaman {PAGENO}|'],
        //     ]
        // ]);
        // return $pdf->render(); 

    //     $filename = 'Data-'.Date('YmdGis').'-Usulan_Kelurahan.xls';
    //     header("Content-type: application/vnd-ms-excel");
    //     header("Content-Disposition: attachment; filename=".$filename);
    //     echo '<table border="1" width="100%">
    //     <thead>
    //         <tr>
    //             <th>No</th>
    //             <th>Kegiatan Prioritas</th>
    //             <th>Kriteria 1</th>
    //             <th>Kriteria 2</th>
    //             <th>Kriteria 3</th>
    //             <th>Kriteria 4</th>
    //             <th>Kriteria 5</th>
    //             <th>Kriteria 6</th>
    //             <th>Kriteria 7</th>
    //             <th>Kriteria 8</th>
    //             <th>Total Skor</th>
    //         </tr>
    //     </thead>';

    //     $no = 1;
    //     foreach($NASUsulan as $value){
    //         echo '
    //             <tr>
    //                 <td> '. $no++ .' </td>
    //                 <td> <b>Permasalahan:</b>
    //                      <p>'. $value->Nm_Permasalahan; .' </p>
    //                      <b>Usulan:</b>
    //                      <p> '. $value->Jenis_Usulan; .' </p>
    //                      </td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //                 <td></td>
    //             </tr>
    //         ';
    //     }
    // echo '</table>';

//         }

//     }

// }
