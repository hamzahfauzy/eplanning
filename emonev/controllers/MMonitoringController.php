<?php

namespace emonev\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\RefKegiatan;
use common\models\RefStandardSatuan;
use emonev\models\TaMonev;

class MMonitoringController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function Posisi()
    {
        $unit = Yii::$app->levelcomponent->getUnit();
        $ret["Kd_Urusan"] = $unit["Kd_Urusan"];
        $ret["Kd_Bidang"] = $unit["Kd_Bidang"];
        $ret["Kd_Unit"] = $unit["Kd_Unit"];
        $ret["Kd_Sub_Unit"] = $unit["Kd_Sub_Unit"];

        return $ret;
    }

    /**
     * Lists all TaBelanjaRinc models.
     * @return mixed
     */
    public function actionIndex()
    {
        $Posisi = $this->Posisi();
        $sub_unit = $Posisi["Kd_Sub_Unit"];
        unset($Posisi["Kd_Sub_Unit"]);
        $Posisi["Kd_Sub"] = $sub_unit;
        $data['Tahun'] = Yii::$app->pengaturan->getTahun();
        $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $data['Model'] = TaMonev::find()->where($Posisi)->all();
        return $this->render("index",$data);
    }

    public function actionEdit($kd,$triwulan)
    {
        $request = Yii::$app->request;
        $kd = explode(".",$kd);
        $model = TaMonev::find()
                    ->where([
                        "Kd_Urusan"=>$kd[0],
                        "Kd_Bidang"=>$kd[1],
                        "Kd_Unit"=>$kd[2],
                        "Kd_Sub"=>$kd[3],
                        "Kd_Prog"=>$kd[4],
                        "Kd_Keg"=>$kd[5],
                    ])->one();
        if ($request->isPost){
            $jumlah_kinerja = "Jumlah_Kinerja_".$triwulan;
            $uang_kinerja = "Uang_Kinerja_".$triwulan;
            $model->{$jumlah_kinerja} = $request->post("jumlah");
            $model->{$uang_kinerja} = $request->post("pagu");
            if($model->save(false))
                return $this->redirect(["m-monitoring/index","edit"=>1]);
        } else {
            $data["model"] = $model;
            $data['Tahun'] = Yii::$app->pengaturan->getTahun();
            $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
            $data['satuan'] = RefStandardSatuan::find()->all();
            return $this->render("form",$data);
        }
        
    }

    public function actionHapus($kd,$triwulan)
    {
        $request = Yii::$app->request;
        $kd = explode(".",$kd);
        $model = TaMonev::find()
                    ->where([
                        "Kd_Urusan"=>$kd[0],
                        "Kd_Bidang"=>$kd[1],
                        "Kd_Unit"=>$kd[2],
                        "Kd_Sub"=>$kd[3],
                        "Kd_Prog"=>$kd[4],
                        "Kd_Keg"=>$kd[5],
                    ])->one();
        $jumlah_kinerja = "Jumlah_Kinerja_".$triwulan;
        $uang_kinerja = "Uang_Kinerja_".$triwulan;
        $model->{$jumlah_kinerja} = 0;
        $model->{$uang_kinerja} = 0;
        if($model->save(false))
            return $this->redirect(["m-monitoring/index","hapus"=>1]);
    }

    public function actionLaporan()
    {
        $Posisi = $this->Posisi();
        $sub_unit = $Posisi["Kd_Sub_Unit"];
        unset($Posisi["Kd_Sub_Unit"]);
        $Posisi["Kd_Sub"] = $sub_unit;
        $data['Tahun'] = Yii::$app->pengaturan->getTahun();
        $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $data['Model'] = TaMonev::find()->where($Posisi)->all();
        return $this->render("laporan",$data);
    }
}