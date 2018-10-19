<?php

namespace referensi\controllers;

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
class ExplorerUserController extends Controller
{
    public function actionIndex()
    { 
        $model = new RefJalan();
        $model->Kd_Prov = 12;
        $model->Kd_Kab = 71;
        /*
        $dataKec = ArrayHelper::map(RefKecamatan::find()
                                ->where(['Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab])
                                ->all()
                        , 'Kd_Kec', 'Nm_Kec');
        */
                        
        $dataKec = RefKecamatan::find()
                ->where(['Kd_Prov' => $model->Kd_Prov, 'Kd_Kab' => $model->Kd_Kab])
                ->all();
                

        return $this->render('index', [
            'dataKec' => $dataKec,
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

    public function actionGetusulan($Kd_Prov, $Kd_Kab,$Kd_Kec, $Kd_Kel, $Kd_Lingkungan)
    {
        $data_usulan=TaForumLingkungan::find()
            ->where(['Kd_Prov' => $Kd_Prov, 'Kd_Kab' => $Kd_Kab, 'Kd_Kec'=>$Kd_Kec, 'Kd_Urut_Kel'=>$Kd_Kel, 'Kd_Lingkungan'=>$Kd_Lingkungan])
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
}
