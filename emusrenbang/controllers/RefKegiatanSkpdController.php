<?php

namespace emusrenbang\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\ErrorException;
// use app\models\RefKegiatan;
use emusrenbang\models\KegiatanSkpd;
use emusrenbang\models\RefKegiatanSkpdSearch;
use common\models\RefUrusan;
// use app\models\RefProgram;
use emusrenbang\models\Referensi;
// use app\models\TaKegiatan;
use common\models\RefProgram;
use common\models\RefKegiatan;
use common\models\TaProgram;
use common\models\Search\TaProgramSearch;
use common\models\TaKegiatan;
use common\models\TaKegiatanSearch;
use common\models\TaSubUnit;

/**
 * RefKegiatanSkpdController implements the CRUD actions for RefKegiatan model.
 */
class RefKegiatanSkpdController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function NASarraymap($data) {
        $NASarray = [
            'Kd_Urusan' => $data['Kd_Urusan'],
            'Kd_Bidang' => $data['Kd_Bidang'],
            'Kd_Unit' => $data['Kd_Unit'],
            'Kd_Sub' => $data['Kd_Sub_Unit']
                //'Kd_Lingkungan' => $data['Kd_Lingkungan'],
        ];

        return $NASarray;
    }

    public function Unit() {
        $unitskpd = Yii::$app->levelcomponent->getUnit();
        $unit = [
            'Kd_Urusan' => $unitskpd['Kd_Urusan'],
            'Kd_Bidang' => $unitskpd['Kd_Bidang'],
            'Kd_Unit' => $unitskpd['Kd_Unit'],
            'Kd_Sub' => $unitskpd['Kd_Sub_Unit'],
        ];
        return $unit;
    }

    public function Kd_User() {
        $user = Yii::$app->user->identity->id;
        return $user;
    }

    /**
     * Lists all RefKegiatan models.
     * @return mixed
     */
    public function actionIndex() {


        $model = new TaProgram();
        $searchModel = new TaProgramSearch();

        $dataProvider = $searchModel->searchProgram(Yii::$app->request->queryParams);
        $modelUnit = TaSubUnit::find()->where($this->Unit())
                ->all();

        $modelLevel = $this->Unit();

        return $this->render('list', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    // 'ref'   => $ref,
                    'modelLevel' => $modelLevel,
                    'modelUnit' => $modelUnit,
                    'mod' => $model
        ]);
    }

    public function actionProgramskpd() {
        $searchModel = new RefKegiatanSkpdSearch();
        // $ref=new Referensi;
        $dataProvider = $searchModel->searchUnit(Yii::$app->request->queryParams);
        // die;
        return $this->render('programSkpd', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider
        ]);
    }

    public function actionKegiatan($id) {

        $searchModel = new TaKegiatanSearch();
        // $ref=new Referensi;
        $cookies = Yii::$app->request->cookies;



        $user = Yii::$app->levelcomponent->getUnit();

        if (empty($cookies['skpd'])) {
            $urusan = $user->Kd_Urusan;
            $bidang = $user->Kd_Bidang;
        } else {
            $urusan = $cookies['urusan']->value;
            $bidang = $cookies['bidang']->value;
        }


        // print_r($bidang); exit();

        $modelProgram = TaProgram::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Prog' => $id])->one();

        $dataProvider = $searchModel->searchKegiatan($id, Yii::$app->request->queryParams);

        $modelUnit = TaSubUnit::find()->where($this->Unit())
                ->all();

        return $this->render('listKegiatan', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    // 'ref'           => $ref,
                    'ketProgram' => $modelProgram['Ket_Prog'],
                    'KdProg' => $modelProgram['Kd_Prog'],
                    'modelUnit' => $modelUnit,
                    'modelProgram' => $modelProgram
        ]);
    }

    /**
     * Displays a single RefKegiatan model.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionView($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg) {
        return $this->render('view', [
                    'model' => $this->findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg),
        ]);
    }

    /**
     * Creates a new RefKegiatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        // $model = new RefKegiatan();
        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    public function actionTambahkeg($id) {
        $modelKeg = new RefKegiatan();
        $modelSkpd = new TaKegiatan();

        $user = Yii::$app->levelcomponent->getUnit();
        $urusan = $user->Kd_Urusan;
        $bidang = $user->Kd_Bidang;
        $unit = $user->Kd_Unit;
        $sub = $user->Kd_Sub_Unit;


        $modelUnit = TaSubUnit::find()->where($this->Unit())
                ->all();
        $modelProgram = TaProgram::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Prog' => $id])->one();


        $fk = $modelKeg
                        ->find()->where([
                    'Kd_Urusan' => $urusan,
                    'Kd_Bidang' => $bidang,
                    'Kd_Prog' => $id
                ])->orderBy(['Kd_Keg' => SORT_DESC])->one();

        if (empty($fk->Kd_Keg)) {
            $kp = 1;
        } else {
            $kp = $fk->Kd_Keg + 1;
        }

        // $modelPro = RefProgram::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])->one();

        if ($modelKeg->load(Yii::$app->request->post())) {

            $modelKeg->Kd_Urusan = (string) $urusan;
            $modelKeg->Kd_Bidang = (string) $bidang;
            $modelKeg->Kd_Prog = $id;

            if ($modelKeg->save()) {



                $simpankegiatan = new TaKegiatan();
                $simpankegiatan->Tahun = date('Y');
                $simpankegiatan->Kd_Urusan = $urusan;
                $simpankegiatan->Kd_Bidang = $bidang;
                $simpankegiatan->Kd_Unit = $unit;
                $simpankegiatan->Kd_Sub = $sub;
                $simpankegiatan->Kd_Prog = $id;
                $simpankegiatan->Kd_Keg = $modelKeg->Kd_Keg;
                $simpankegiatan->Ket_Kegiatan = $modelKeg->Ket_Kegiatan;
                $simpankegiatan->Status_Kegiatan = 0;
                $simpankegiatan->Status = 0;
                $simpankegiatan->Keterangan = "-";

                $simpankegiatan->save(false);

                return $this->redirect(['kegiatan', 'id' => $id]);
            }

        } else {
            return $this->render('newKeg', [
                        'nameTag' => "Tambah Usulan Kegiatan",
                        'nameAction' => "Tambah",
                        'model' => $modelKeg,
                        'ketProgram' => $modelProgram['Ket_Prog'],
                        'KdProg' => $modelProgram['Kd_Prog'],
                        'kp' => $kp,
                        'modelUnit' => $modelUnit,
                        'ketProg' => $modelProgram['Ket_Prog']
            ]);
        }
    }

    public function actionCreatekegiatan() {
        $model = new RefKegiatan();
        $modelkegiatan = new KegiatanSkpd();

        $username = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {
            $created_at = date('Y-m-d h:i:s');
            $updated_at = date('Y-m-d h:i:s');
            $Kd_Kegiatan = $model->Kd_Keg;
            $Kd_Unit = Yii::$app->user->identity->id_skpd;
            $query = "insert into kegiatan_skpd (Kd_Unit, Kd_Kegiatan, created_at, updated_at, username) values ('$Kd_Unit', '$Kd_Kegiatan', '$created_at', '$updated_at', '$username')";
            $db = Yii::$app->db->createCommand($query)->execute();
            if ($db) {
                return $this->redirect(['kegiatan-skpd/index']);
            }
        } else {
            return $this->render('createkegiatan', [
                        'model' => $model,
            ]);
        }
    }


    public function getUrusan() {
        $model = RefUrusan::find()->all();
        $data = array();
        foreach ($model as $d) {
            $data[$d['Kd_Urusan']] = $d['Nm_Urusan'];
        }
        return $data;
    }

    public function actionListprogram($urusan) {
        $this->layout = 'blank';
        $id_skpd = Yii::$app->user->identity->id_skpd;
        $i = explode(".", $id_skpd);
        $model = RefProgram::find()->select('*')->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $i[1]])->all();
        echo "<option>Pilih Program</option>";
        foreach ($model as $d) {
            echo "<option value='$d[Kd_Prog]'>$d[Ket_Program]</option>";
        }
    }

    public function actionListkegiatan($prog, $urusan) {
        $this->layout = 'blank';
        $id_skpd = Yii::$app->user->identity->id_skpd;
        $i = explode(".", $id_skpd);
        $model = RefKegiatan::find()->select('*')->where(['Kd_Prog' => $prog, 'Kd_Urusan' => $urusan, 'Kd_Bidang' => $i[1]])->all();
        echo "<option>Pilih Usulan Kegiatan</option>";
        foreach ($model as $d) {
            echo "<option value='$d[Kd_Urusan].$d[Kd_Bidang].$d[Kd_Prog].$d[Kd_Keg]'>$d[Ket_Kegiatan]</option>";
        }
    }

    public function actionUpdate($tahun, $Kd_Prog, $Kd_Keg) {
        $modelSkpd = new KegiatanSkpd();

        $urusan = Yii::$app->user->identity->id_urusan;
        $bidang = Yii::$app->user->identity->id_bidang;

        $modelKeg = $this->findModel($urusan, $bidang, $Kd_Prog, $Kd_Keg);
        $modelPro = RefProgram::find()->where(['Kd_Urusan' => $urusan, 'Kd_Bidang' => $bidang, 'Kd_Prog' => $Kd_Prog])->one();
        if ($modelKeg->load(Yii::$app->request->post())) {

            $modelKeg->Kd_Urusan = (string) $urusan;
            $modelKeg->Kd_Bidang = (string) $bidang;
            $modelKeg->Kd_Prog = $Kd_Prog;
            $modelKeg->load(Yii::$app->request->post());
            $modelKeg->Kd_Keg = $Kd_Keg;
            try {
                if ($modelKeg->save()) {
                    $unit = Yii::$app->user->identity->id_skpd;
                    $username = Yii::$app->user->identity->username;
                    $dt = (new \ DateTime())->format('Y-m-d h:i:s');

                    $unit = Yii::$app->user->identity->id_skpd;
                    $sub = Yii::$app->user->identity->id_subunit;

                    if ($sub != 0) {
                        $mesub = $sub;
                    } else {
                        $mesub = $unit;
                    }

                    $sql = "update kegiatan_skpd set Kd_Kegiatan=$Kd_Keg , updated_at='$dt', username='$username'
                        where tahun=$tahun and
                        Kd_Urusan  = $urusan and
                        Kd_Bidang  = $bidang and
                        Kd_Unit    = $unit and
                        Kd_Sub     = $mesub and
                        Kd_Program = $Kd_Prog and
                        Kd_Kegiatan= $Kd_Keg";
                    $query = Yii::$app->db->createCommand($sql)->execute();
                }
            } catch (ErrorException $e) {
                
            }

            return $this->redirect(['kegiatan', 'id' => $Kd_Prog]);
        } else {
            return $this->render('newKeg', [
                        'nameTag' => "Ubah Usulan Kegiatan",
                        'nameAction' => "Ubah",
                        'model' => $modelKeg,
                        'ketProgram' => $modelPro['Ket_Program'],
                        'KdProg' => $modelPro['Kd_Prog'],
                        'kp' => $modelKeg->Kd_Keg
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing RefKegiatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return mixed
     */
    public function actionDelete($tahun, $Kd_Prog, $Kd_Keg) {
        $urusan = Yii::$app->user->identity->id_urusan;
        $bidang = Yii::$app->user->identity->id_bidang;
        $unit = Yii::$app->user->identity->id_skpd;
        $sub = Yii::$app->user->identity->id_subunit;

        $ref = new Referensi;
        $objeck = $ref->getListBelanjaCount($Kd_Prog, $Kd_Keg);
        $taKegiatan = $ref->getCountUrusan($Kd_Prog, $Kd_Keg);
        $indikator = $ref->getCountIndikator($Kd_Prog, $Kd_Keg);

        if ($objeck) {
            Yii::$app->session->setFlash('error', "Kegiatan tidak dapat di hapus karena sudah memiliki objek rincian.");
        } else {
            try {
                $sql = "DELETE FROM Ref_Kegiatan WHERE
                    Kd_Urusan=$urusan AND
                    Kd_Bidang=$bidang AND
                    Kd_Prog = $Kd_Prog AND
                    Kd_Keg  = $Kd_Keg
                ";

                $query = Yii::$app->db->createCommand($sql)->execute();

                $sql = "DELETE FROM kegiatan_skpd WHERE
                    tahun=$tahun and
                    Kd_Urusan=$urusan AND
                    Kd_Bidang=$bidang AND
                    Kd_Unit = $unit AND
                    Kd_Program = $Kd_Prog AND
                    Kd_Kegiatan = $Kd_Keg
                ";

                $query = Yii::$app->db->createCommand($sql)->execute();

                if ($taKegiatan) {
                    $sql = "DELETE FROM Ta_Kegiatan WHERE
                        Tahun=$tahun and
                        Kd_Urusan=$urusan AND
                        Kd_Bidang=$bidang AND
                        Kd_Unit = $unit AND
                        Kd_Sub = $sub AND
                        Kd_Prog = $Kd_Prog AND
                        Kd_Keg  = $Kd_Keg
                    ";

                    $query = Yii::$app->db->createCommand($sql)->execute();
                }

                if ($indikator) {
                    $sql = "DELETE FROM Ta_Indikator WHERE
                        Tahun=$tahun and
                        Kd_Urusan=$urusan AND
                        Kd_Bidang=$bidang AND
                        Kd_Unit = $unit AND
                        Kd_Sub = $sub AND
                        Kd_Prog = $Kd_Prog AND
                        Kd_Keg  = $Kd_Keg
                    ";

                    $query = Yii::$app->db->createCommand($sql)->execute();
                }
            } catch (Exception $e) {
                
            }
        }
        return $this->redirect(['kegiatan', 'id' => $Kd_Prog]);
    }

    /**
     * Finds the RefKegiatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @return RefKegiatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Kd_Urusan, $Kd_Bidang, $Kd_Prog, $Kd_Keg) {
        if (($model = RefKegiatan::findOne(['Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
