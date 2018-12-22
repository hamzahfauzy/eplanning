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

class MProgramKegiatanController extends Controller
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

    /**
     * Lists all TaBelanjaRinc models.
     * @return mixed
     */
    public function actionIndex($tahun=false)
    {
        $Posisi = $this->Posisi();
        $sub_unit = $Posisi["Kd_Sub_Unit"];
        unset($Posisi["Kd_Sub_Unit"]);
        $Posisi["Kd_Sub"] = $sub_unit;
        $Posisi["Tahun"] = $tahun == false ? Yii::$app->pengaturan->getTahun() : $tahun;
        $data['Tahun'] = $Posisi["Tahun"];
        $list_tahun = [];
        for($i=2016;$i<=Yii::$app->pengaturan->getTahun();$i++)
        {
            $list_tahun[] = $i;
        }
        $data["list_tahun"] = $list_tahun;
        $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $data['Model'] = TaMonev::find()->where($Posisi)->all();
        return $this->render("index",$data);
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

    public function actionImport($tahun = false)
    {
        $Posisi = $this->Posisi();
        $thn = $tahun == false ? Yii::$app->pengaturan->getTahun() : $tahun;
        $kegiatan = RefKegiatan::find()->where($Posisi)->all();
        $sub_unit = $Posisi["Kd_Sub_Unit"];
        unset($Posisi["Kd_Sub_Unit"]);
        $Posisi["Kd_Sub"] = $sub_unit;
        $Posisi["Tahun"] = $thn;
        $model = TaMonev::find()->where($Posisi)->all();
        if(!empty($model))
        {
            return $this->redirect(["m-program-kegiatan/index","error" => 1]);
        }
        foreach($kegiatan as $value)
        {
            $model = new TaMonev;
            $model->Tahun = $thn;
            $model->Kd_Urusan = $value["Kd_Urusan"];
            $model->Kd_Bidang = $value["Kd_Bidang"];
            $model->Kd_Unit = $value["Kd_Unit"];
            $model->Kd_Sub = $value["Kd_Sub_Unit"];
            $model->Kd_Prog = $value["Kd_Prog"];
            $model->Kd_Keg = $value["Kd_Keg"];
            $model->Ket_Keg = $value["Ket_Kegiatan"];
            $model->Indikator = $value["Indikator"];
            $model->Satuan = $value["Satuan0"];
            $model->Pagu_Target_RPJMD = $value["Tahun_Akhir"];
            $model->Target_RPJMD = $value["Satuan0x"];
            $model->save(false);
        }

        return $this->redirect(["m-program-kegiatan/index"]);
    }

    public function actionHapus($kd,$tahun)
    {
        $kd = explode(".",$kd);
        $model = TaMonev::find()
                ->where([
                    "Tahun"=>$tahun,
                    "Kd_Urusan"=>$kd[0],
                    "Kd_Bidang"=>$kd[1],
                    "Kd_Unit"=>$kd[2],
                    "Kd_Sub"=>$kd[3],
                    "Kd_Prog"=>$kd[4],
                    "Kd_Keg"=>$kd[5],
                ])->one();
        $model->delete();
        return $this->redirect(["m-program-kegiatan/index","delete" => 1]);
    }

    public function actionEdit($kd,$tahun)
    {
        $request = Yii::$app->request;
        $kd = explode(".",$kd);
        $model = TaMonev::find()
                    ->where([
                        "Tahun"=>$tahun,
                        "Kd_Urusan"=>$kd[0],
                        "Kd_Bidang"=>$kd[1],
                        "Kd_Unit"=>$kd[2],
                        "Kd_Sub"=>$kd[3],
                        "Kd_Prog"=>$kd[4],
                        "Kd_Keg"=>$kd[5],
                    ])->one();
        if ($request->isPost){
            $model->Target = $request->post("target");
            $model->Pagu_Target = $request->post("pagu_target");
            if($model->save(false))
                return $this->redirect(["m-program-kegiatan/index","edit"=>1,"tahun"=>$tahun]);
        } else {
            $data["model"] = $model;
            $data['Tahun'] = $tahun;
            $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
            $data['satuan'] = RefStandardSatuan::find()->all();
            return $this->render("form",$data);
        }
        
    }
}