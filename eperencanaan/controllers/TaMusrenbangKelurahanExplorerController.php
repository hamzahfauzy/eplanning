<?php

namespace eperencanaan\controllers;

use Yii;
use common\models\RefKecamatan;
use common\models\search\RefKecamatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\RefKelurahan;
use common\models\RefJalan;
use common\models\RefLingkungan;
use eperencanaan\models\TaForumLingkungan;
/**
 * RefKecamatanController implements the CRUD actions for RefKecamatan model.
 */
class TaMusrenbangKelurahanExplorerController extends Controller
{
    public function ZULAsal(){
        $ZULkelompok = Yii::$app->levelcomponent->getKelompok();
        return [
            'Kd_Prov' => $ZULkelompok->Kd_Prov,
            'Kd_Kab' => $ZULkelompok->Kd_Kab,
            'Kd_Kec' => $ZULkelompok->Kd_Kec,
            'Kd_Kel' => $ZULkelompok->Kd_Kel,
            'Kd_Urut' => $ZULkelompok->Kd_Urut_Kel
        ];
    }
    
    public function actionIndex()
    { 
        $dataKec = RefKelurahan::findOne($this->ZULAsal());
        $ZULasal = $this->ZULAsal();
        $ZULasal['Kd_Urut_Kel'] = $ZULasal['Kd_Urut'];
        unset($ZULasal['Kd_Urut']);
        $dataUsulanKelurahan = \eperencanaan\models\TaMusrenbangKelurahan::find()
                ->where($ZULasal)
                ->all();
        //print()
        return $this->render('index', [
            'dataKec' => $dataKec,
            'dataUsulanKelurahan' => $dataUsulanKelurahan
        ]);
    }

    public function actionGetkel($Kd_Prov, $Kd_Kab, $Kd_Kec)
    {
        $data=RefKelurahan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec])
            ->all();

        return $this-> renderPartial('data_kelurahan', [ 
            'data' => $data
        ]);
        /*
        foreach ($data as $key => $value) {
            $Kd_Prov= $value['Kd_Prov'];
            $Kd_Kab= $value['Kd_Kab'];
            $Kd_Kec= $value['Kd_Kec'];
            $Kd_Urut= $value['Kd_Urut'];
            $Nm_Kel= $value['Nm_Kel'];
            echo "<li data-prov='$Kd_Prov' data-kab='$Kd_Kab' data-kec='$Kd_Kec' data-urut='$Kd_Urut' class='data-kel'>$Nm_Kel($Kd_Urut)</li>";
        }
        */
    }

    public function actionGetling($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel)
    {
        $data=RefLingkungan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel])
            ->all();

        return $this-> renderPartial('data_lingkungan', [ 
            'data' => $data
        ]);
    }

    public function actionGetjalan($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel, $Kd_Lingkungan)
    {
        $data_jalan=RefJalan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel, 'Kd_Lingkungan'=>$Kd_Lingkungan])
            ->all();

        return $this-> renderPartial('data_jalan', [ 
            'data' => $data_jalan
        ]);
    }

    public function actionGetusulan($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel, $Kd_Ling, $status)
    {
        $data_usulan=TaForumLingkungan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel, 'Kd_Lingkungan'=>$Kd_Ling, 'Status_Pembahasan'=>$status])
            ->all();

        return $this-> renderPartial('data_usulan', [ 
            'data' => $data_usulan
        ]);
    }

    public function actionGetusulanjalan($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel, $Kd_Lingkungan, $Kd_Jalan)
    {
        $data_usulanjalan=TaForumLingkungan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel, 'Kd_Lingkungan'=>$Kd_Lingkungan, 'Kd_Jalan'=>$Kd_Jalan])
            ->all();

        return $this-> renderPartial('data_usulan_jalan', [ 
            'data' => $data_usulanjalan
        ]);
    }

    public function actionHapuslingkungan()
    {
        $request = Yii::$app->request;
        $prov = $request->post('prov');
        $kab = $request->post('kab');
        $kec = $request->post('kec');
        $kel = $request->post('kel');
        $urutkel = $request->post('urutkel');
        $lingkungan = $request->post('lingkungan');
        //echo "'Kd_Prov' => $prov, 'Kd_Kab' => $kab, 'Kd_Kec' => $kec, 'Kd_Kel' => $kel, 'Kd_Urut_Kel' => $urutkel, 'Kd_Lingkungan' => $lingkungan";
        
        if ($model = RefLingkungan::findOne(['Kd_Prov' => $prov, 'Kd_Kab' => $kab, 'Kd_Kec' => $kec, 'Kd_Kel' => $kel, 'Kd_Urut_Kel' => $urutkel, 'Kd_Lingkungan' => $lingkungan])->delete()) {
            echo 'Berhasil';
        }
        else{
            echo 'Gagal';
        }
        
        //echo "$prov $lingkungan";
        //$this->findModellingkungan($prov, $kab, $kec, $Kd_Kel, $urut, $lingkungan)->delete();
    }

    public function actionModalDetailKecamatan()
    {
        $request = Yii::$app->request;
        $prov = $request->post('prov');
        $kab = $request->post('kab');
        $kec = $request->post('kec');

        $data_usulan=RefKecamatan::find()
            ->where(['Kd_Prov' => $prov, 'Kd_Kab' => $kab, 'Kd_Kec'=>$kec])
            ->all();

        //print_r($data_usulan);
        
        return $this-> renderPartial('modal_detail_kecamatan', [ 
            'data' => $data_usulan
        ]);
        
    }
    
    public function actionGetPj($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel, $Kd_Ling)
    {
        $data_usulan = \userlevel\models\TaUserKelompok::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel, 'Kd_Lingkungan'=>$Kd_Ling])
            ->one()
            ->Kd_User;
        //print_r($data_usulan);exit;
        $data_pj = \userlevel\models\User::findOne(['id' => $data_usulan]);
        $nama_pj = \userlevel\models\TaProfile::findOne(['Kd_User' => $data_usulan]);
        //print_r($data_pj);exit;
        return '<tr><td>ID </td><td>:</td><td> '.$data_pj->id.'</tr>'.
                '<tr><td>Username </td><td>:</td><td> '.$data_pj->username.'</tr>'.
                '<tr><td>Nama Lengkap </td><td>:</td><td> '.$nama_pj->Nm_Lengkap.'</tr>'.
                
                '<tr><td>No Handphone </td><td>:</td><td> '.$nama_pj->Mobile.'</tr>'
                ;
        
    }
    
    public function actionGetUsulanKompilasi($Kd_Ta_Musrenbang_Kelurahan){
        $ZULusulan = \eperencanaan\models\TaMusrenbangKelurahan::findOne(['Kd_Ta_Musrenbang_Kelurahan'=>$Kd_Ta_Musrenbang_Kelurahan]);
        $data = '';
        $no=1;
        foreach ($ZULusulan->getKdTaMusrenbangKelurahanVerifikasis()->all() as $usulan){
            $data .=  '<tr><td>'.$no.'. </td><td> '.$usulan->Nm_Permasalahan.'</tr>';$no++;
        }
        return $data;
    }
}
