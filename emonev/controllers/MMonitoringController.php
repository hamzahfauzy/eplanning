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

    public function actionEdit($kd,$triwulan,$tahun)
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
            $jumlah_kinerja = "Jumlah_Kinerja_".$triwulan;
            $uang_kinerja = "Uang_Kinerja_".$triwulan;
            $model->{$jumlah_kinerja} = $request->post("jumlah");
            $model->{$uang_kinerja} = $request->post("pagu");
            if($model->save(false))
                return $this->redirect(["m-monitoring/index","edit"=>1,"tahun"=>$tahun,"triwulan"=>$triwulan]);
        } else {
            $data["model"] = $model;
            $data['Tahun'] = $tahun;
            $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
            $data['satuan'] = RefStandardSatuan::find()->all();
            return $this->render("form",$data);
        }
        
    }

    public function actionHapus($kd,$triwulan,$tahun)
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
        $jumlah_kinerja = "Jumlah_Kinerja_".$triwulan;
        $uang_kinerja = "Uang_Kinerja_".$triwulan;
        $model->{$jumlah_kinerja} = 0;
        $model->{$uang_kinerja} = 0;
        if($model->save(false))
            return $this->redirect(["m-monitoring/index","hapus"=>1,"tahun"=>$tahun,"triwulan"=>$triwulan]);
    }

    public function actionLaporan($tahun = false)
    {
        $Posisi = $this->Posisi();
        $sub_unit = $Posisi["Kd_Sub_Unit"];
        unset($Posisi["Kd_Sub_Unit"]);
        $Posisi["Kd_Sub"] = $sub_unit;
        $Posisi["Tahun"] = $tahun == false ? Yii::$app->pengaturan->getTahun() : $tahun;
        $data['Tahun'] = Yii::$app->pengaturan->getTahun();
        $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $data['Model'] = TaMonev::find()->where($Posisi)->all();

        $list_tahun = [];
        for($i=2016;$i<=Yii::$app->pengaturan->getTahun();$i++)
        {
            $list_tahun[] = $i;
        }
        $data["list_tahun"] = $list_tahun;

        $old_data = function($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog,$Kd_Keg)
        {
            $model = TaMonev::find()->where([
                    "Kd_Urusan"=>$Kd_Urusan,
                    "Kd_Bidang"=>$Kd_Bidang,
                    "Kd_Unit"=>$Kd_Unit,
                    "Kd_Sub"=>$Kd_Sub,
                    "Kd_Prog"=>$Kd_Prog,
                    "Kd_Keg"=>$Kd_Keg,
                ])
                ->andWhere(["<","Tahun",$Tahun])
                ->all();
                $data_k = 0;
                $data_rp = 0;
            foreach($model as $row)
            {
                $data_k += $row->Jumlah_Kinerja_1;
                $data_k += $row->Jumlah_Kinerja_2;
                $data_k += $row->Jumlah_Kinerja_3;
                $data_k += $row->Jumlah_Kinerja_4;

                $data_rp += $row->Uang_Kinerja_1;
                $data_rp += $row->Uang_Kinerja_2;
                $data_rp += $row->Uang_Kinerja_3;
                $data_rp += $row->Uang_Kinerja_4;
            }

            return json_decode(json_encode(["K" => $data_k, "RP" => $data_rp]));
        };

        $data["old_data"] = $old_data;

        return $this->render("laporan",$data);
    }

    public function actionLaporanTahunan($tahun = false)
    {
        $Posisi = $this->Posisi();
        $sub_unit = $Posisi["Kd_Sub_Unit"];
        unset($Posisi["Kd_Sub_Unit"]);
        $Posisi["Kd_Sub"] = $sub_unit;
        $Posisi["Tahun"] = $tahun == false ? Yii::$app->pengaturan->getTahun() : $tahun;
        $data['Tahun'] = Yii::$app->pengaturan->getTahun();
        $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $data['Model'] = TaMonev::find()->where($Posisi)->all();

        $list_tahun = [];
        for($i=2016;$i<=Yii::$app->pengaturan->getTahun();$i++)
        {
            $list_tahun[] = $i;
        }
        $data["list_tahun"] = $list_tahun;

        return $this->render("laporan-tahunan",$data);
    }

    public function actionLaporanBappeda($tahun = false)
    {
        // $Posisi["Tahun"] = Yii::$app->pengaturan->getTahun();
        $Posisi["Tahun"] = $tahun == false ? Yii::$app->pengaturan->getTahun() : $tahun;
        $data['Tahun'] = Yii::$app->pengaturan->getTahun();
        $data['Nm_Pemda'] = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        $data['Model'] = TaMonev::find()->where($Posisi)->orderby([
            "Kd_Urusan" => SORT_ASC,
            "Kd_Bidang" => SORT_ASC,
            "Kd_Unit" => SORT_ASC,
            "Kd_Sub" => SORT_ASC,
            "Kd_Prog" => SORT_ASC,
            "Kd_Keg" => SORT_ASC,
        ])->all();

        $list_tahun = [];
        for($i=2016;$i<=Yii::$app->pengaturan->getTahun();$i++)
        {
            $list_tahun[] = $i;
        }
        $data["list_tahun"] = $list_tahun;

        $old_data = function($Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog,$Kd_Keg)
        {
            $model = TaMonev::find()->where([
                    "Kd_Urusan"=>$Kd_Urusan,
                    "Kd_Bidang"=>$Kd_Bidang,
                    "Kd_Unit"=>$Kd_Unit,
                    "Kd_Sub"=>$Kd_Sub,
                    "Kd_Prog"=>$Kd_Prog,
                    "Kd_Keg"=>$Kd_Keg,
                ])
                ->andWhere(["<","Tahun",Yii::$app->pengaturan->getTahun()])
                ->all();
                $data_k = 0;
                $data_rp = 0;
            foreach($model as $row)
            {
                $data_k += $row->Jumlah_Kinerja_1;
                $data_k += $row->Jumlah_Kinerja_2;
                $data_k += $row->Jumlah_Kinerja_3;
                $data_k += $row->Jumlah_Kinerja_4;

                $data_rp += $row->Uang_Kinerja_1;
                $data_rp += $row->Uang_Kinerja_2;
                $data_rp += $row->Uang_Kinerja_3;
                $data_rp += $row->Uang_Kinerja_4;
            }

            return json_decode(json_encode(["K" => $data_k, "RP" => $data_rp]));
        };

        $data["old_data"] = $old_data;

        return $this->render("laporan",$data);
    }
}