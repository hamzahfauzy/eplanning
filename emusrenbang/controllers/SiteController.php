<?php

namespace emusrenbang\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use emusrenbang\models\Pages;
use emusrenbang\models\Programs;
use emusrenbang\models\Kegiatans;
use emusrenbang\models\DetailKegiatan;
use emusrenbang\models\UraianKegiatan;
use emusrenbang\models\News;
use emusrenbang\models\Savelog;
use emusrenbang\models\User;
use common\models\TaSubUnit;
use common\models\TaProgram;
use common\models\RefSubUnit;
use emusrenbang\models\TaPaguProgram;
use common\models\TaKegiatan;
use eperencanaan\models\TaMusrenbang;
use emusrenbang\models\TaBelanja;
use common\models\TaPaguSubUnit;
use emusrenbang\models\TaBelanjaRincSub;
use eperencanaan\models\TaForumLingkungan;

/**
 * Site controller
 */
class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'home', 'contact'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'lout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function PosisiUnit() {
        $unitskpd = Yii::$app->levelcomponent->getUnit();
        return [
            'Tahun' => date('Y'),
            'Kd_Urusan' => $unitskpd['Kd_Urusan'],
            'Kd_Bidang' => $unitskpd['Kd_Bidang'],
            'Kd_Unit' => $unitskpd['Kd_Unit'],
            'Kd_Sub' => $unitskpd['Kd_Sub_Unit'],
        ];
    }

    public function beforeAction($action) {
        if (!parent::beforeAction($action)) {
            return false;
        }

        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->session['userSessionTimeout'] < time()) {
                $cookies = Yii::$app->response->cookies;
                unset($cookies['limit']);
                return $this->redirect(['site/lout']);
            } else {
                Yii::$app->session->set('userSessionTimeout', time() + (Yii::$app->params['sessionTimeoutSeconds']));

                return true;
            }
        } else {

            return true;
        }
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionMap() {
        return $this->render('map');
    }
/*
    public function actionUsulan() {
        //  $this->layout="dashboard";
        $kode_skpd = Yii::$app->user->skpd;
        $dataProgram = $this->getProgram($kode_skpd);

        return $this->render('index', ['dataProgram' => $dataProgram, 'all' => $this]);
    }
    private function getProgram($id) {
        $dataProgram = Programs::find()->where(['id_prioritas' => ''])->all();

        foreach ($dataProgram as $data) {
            $d[$data['id']] = "(" . $data['id'] . ") " . $data['nama_program'];
        }
        if (isset($d)) {
            return $d;
        }
    }

    public function getDetailKegiatan($kode_kegiatan, $tahun) {
        $detail = DetailKegiatan::find()->where(['kode_kegiatan' => $kode_kegiatan, 'tahun' => $tahun])->One();
        return $detail;
    }

    public function getKegiatan($id) {
        $dataKegiatan = Kegiatans::findAll(['left(kode_kegiatan,10)' => $id, 'aktif' => '1']);

        foreach ($dataKegiatan as $data) {
            $d[$data['kode_kegiatan']] = "(" . $data['kode_kegiatan'] . ") " . $data['nama_kegiatan'];
        }
        if (isset($d)) {
            return $d;
        }
    }

    public function getUraiankegiatan($id, $tahun) {
        $dataUraian = UraianKegiatan::findAll(['kode_kegiatan' => $id, 'tahun' => $tahun]);
        return $dataUraian;
    }

    public function actionPage($id) {
        //$this->layout="page";
        $model = Pages::findOne(['title_seo' => $id]);
        return $this->render('page', [
                    'model' => $model,
        ]);
    }
*/
    public function actionIndex() {
        $Tahun = Yii::$app->pengaturan->getTahun();
        $Nm_Pemda = Yii::$app->pengaturan->Kolom('Nm_Pemda');
        
        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {

            $TaSubUnit = TaSubUnit::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->one();

            $unitskpd = Yii::$app->levelcomponent->getUnit();

            if (!isset($TaSubUnit)) {

                $TaSubUnit = new TaSubUnit;
                $TaSubUnit->Tahun = $Tahun;
                $TaSubUnit->Kd_Urusan = $unitskpd->Kd_Urusan;
                $TaSubUnit->Kd_Bidang = $unitskpd->Kd_Bidang;
                $TaSubUnit->Kd_Unit = $unitskpd->Kd_Unit;
                $TaSubUnit->Kd_Sub = $unitskpd->Kd_Sub_Unit;
            }

            $TaPaguProgram = TaProgram::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->one();

            $modelProgram = TaProgram::find()->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['Tahun' => $Tahun])
                    ->count();

            $modelKegiatan = TaKegiatan::find()->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['Tahun' => $TaSubUnit->Tahun])
                    ->count();

            $modelLingkungan = TaMusrenbang::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['>', 'Skor', 0])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['!=', 'Kd_Lingkungan', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['1', '2']])
                    ->andWhere(['Tahun' => $Tahun])
                    ->count();

            $modelKelurahan = TaMusrenbang::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['>', 'Skor', 0])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['!=', 'Kd_Urut_Kel', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['2', '3']])
                    ->andWhere(['Tahun' => $Tahun])
                    ->count();

            $modelKecamatan = TaMusrenbang::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['!=', 'Kd_Kec', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['3']])
                    ->andWhere(['Tahun' => $Tahun])
                    ->count();

            $modelPokir = TaMusrenbang::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['Kd_Asal_Usulan' => 5])
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kelurahan' => '1'],
                        ['Status_Penerimaan_Kelurahan' => '2']
                    ])
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2']
                    ])
                    ->andWhere(['Tahun' => $Tahun])
                    ->count();

            $modelTotal = TaMusrenbang::find()->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['Tahun' => $Tahun])
                    ->count();

            $modelBelanja = TaBelanja::find()->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['Tahun' => $Tahun])
                    ->count();

            $modelGraph = TaMusrenbang::find()
                    ->where(Yii::$app->levelcomponent->PosisiUnit())
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kelurahan' => '1'],
                        ['Status_Penerimaan_Kelurahan' => '2']
                    ])
                    ->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2']
                    ])
                    ->andWhere(['Tahun' => $Tahun]);

            $usulanPerSubUnit = 0;

            $total_belanja = $TaSubUnit->getBelanjaRincSubs()->sum('Total');

            $where = 'Kd_Prioritas_Pembangunan_Daerah not in (0) and (Status_Penerimaan_Kelurahan in (1,2) or Status_Penerimaan_Kecamatan in (1,2))';

            $jumlahUsulan = null;
            $TaMusrenbang = TaMusrenbang::find()
                    ->select('Kd_Pem, Kd_Prioritas_Pembangunan_Daerah, count(*) as jumlah')
                    ->where($where)
                    ->andWhere($this->PosisiUnit())
                    ->groupBy('Kd_Pem, Kd_Prioritas_Pembangunan_Daerah')
                    ->orderBy('Kd_Pem, Kd_Prioritas_Pembangunan_Daerah')
                    ->all();

            foreach ($TaMusrenbang as $key => $value) {
                $jumlahUsulan[$value->Kd_Pem - 1][$value->Kd_Prioritas_Pembangunan_Daerah - 1] = (int) $value->jumlah;
            }

            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 8; $j++) {
                    $jumlahUsulan[$i][$j] = isset($jumlahUsulan[$i][$j]) ? $jumlahUsulan[$i][$j] : 0;
                }
                ksort($jumlahUsulan[$i]);
            }

            return $this->render('index', [
                        'jumlahUsulan' => $jumlahUsulan,
                        'modelProgram' => $modelProgram,
                        'modelKegiatan' => $modelKegiatan,
                        'modelLingkungan' => $modelLingkungan,
                        'modelKelurahan' => $modelKelurahan,
                        'modelKecamatan' => $modelKecamatan,
                        'modelPokir' => $modelPokir,
                        'modelGraph' => $modelGraph,
                        'modelTotal' => $modelTotal,
                        'modelBelanja' => $modelBelanja,
                        'TaSubUnit' => $TaSubUnit,
                        'TaPaguProgram' => $TaPaguProgram,
                        'total_belanja' => $total_belanja,
                        'Nm_Pemda' => $Nm_Pemda,
            ]);
        } 
        else {

            $Tahun = Yii::$app->pengaturan->getTahun();

            $RefSubUnitCount = RefSubUnit::find()
                    ->count();

            $TaSubUnit = TaSubUnit::find()
                    ->where(['Tahun' => $Tahun])
                    ->all();

            $TaPaguSubUnit = TaPaguSubUnit::find()
                    ->where(['Tahun' => $Tahun])
                    ->sum('pagu');

            $TaPaguProgram = TaPaguProgram::find()
                    ->where(['Tahun' => $Tahun])
                    ->sum('pagu');

            $modelProgram = TaProgram::find()
                    ->where(['Tahun' => $Tahun])
                    ->count();

            $belanjarincsub = TaBelanjaRincSub::find()->sum('Total');

            $modelLingkungan = TaForumLingkungan::find()
                    ->count();

            $modelKelurahan = TaMusrenbang::find()
                    ->andWhere(['Tahun' => $Tahun])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['!=', 'Kd_Urut_Kel', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['1', '2']])
					->andWhere(['>', 'Skor', 0])
                    ->count();

            $modelKecamatan = TaMusrenbang::find()
                    ->andWhere(['Tahun' => $Tahun])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['3']])
                    ->count();

            $modelPokir = TaMusrenbang::find()
                    ->where(['Tahun' => $Tahun])
                    ->andWhere(['Kd_Asal_Usulan' => 5])
                    ->count();
			$modelForum = TaMusrenbang::find()
                    ->where(['Tahun' => $Tahun])
					->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
                    ])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['OR',
                            ['>', 'skor', 0],
                            ['!=', 'Kd_Kec', 0],
                        ])
                    ->count();

            $where = 'Kd_Prioritas_Pembangunan_Daerah not in (0)';
            $jumlahUsulan = null;
            $TaMusrenbang = TaMusrenbang::find()
                    ->select('Kd_Pem, Kd_Prioritas_Pembangunan_Daerah, count(*) as jumlah')
                    ->where($where)
                    ->groupBy('Kd_Pem, Kd_Prioritas_Pembangunan_Daerah')
                    ->orderBy('Kd_Pem, Kd_Prioritas_Pembangunan_Daerah')
                    ->all();

            foreach ($TaMusrenbang as $key => $value) {
                $jumlahUsulan[$value->Kd_Pem - 1][$value->Kd_Prioritas_Pembangunan_Daerah - 1] = (int) $value->jumlah;
            }

            for ($i = 0; $i < 3; $i++) {
                for ($j = 0; $j < 8; $j++) {
                    $jumlahUsulan[$i][$j] = isset($jumlahUsulan[$i][$j]) ? $jumlahUsulan[$i][$j] : 0;
                }
                ksort($jumlahUsulan[$i]);
            }

            return $this->render('index-admin', [
                        'jumlahUsulan' => $jumlahUsulan,
                        'RefSubUnitCount' => $RefSubUnitCount,
                        'TaSubUnit' => $TaSubUnit,
                        'modelProgram' => $modelProgram,
                        'modelLingkungan' => $modelLingkungan,
                        'modelKelurahan' => $modelKelurahan,
                        'modelKecamatan' => $modelKecamatan,
                        'modelPokir' => $modelPokir,
						'modelForum' => $modelForum,
                        'TaPaguSubUnit' => $TaPaguSubUnit,
                        'TaPaguProgram' => $TaPaguProgram,
                        'belanjarincsub' => $belanjarincsub,
                        'Nm_Pemda' => $Nm_Pemda,
            ]);
        }
    }

    public function actionLogin() {
        $this->layout = 'main-front';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        $limit = 1;
        $message = "";

        $cookies = Yii::$app->request->cookies;
        if ($cookies->has('limit')) {
            $limit = $cookies->getValue('limit');
        }

        if ($model->load(Yii::$app->request->post())) {
            // $cekUser = User::findOne(['username' => $model->username]);
            $cekUser = $this->getUser($model->username);

            if ($cekUser['aktif'] == 1 && !($logakhir = $cekUser->LogAkhir)) {
                // echo "ok";
                if ($model->login()) {
                    $cekUser->aktif = 1;
                    if($cekUser->save(false)){
                        Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
                        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
                        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
                        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
                        $log = new Savelog();
                        $log->save('login berhasil', 'login', '', ''); //pesan, kegiatan, tabel, id dari tabel
                    }
                }
                
                return $this->goBack();
            }
            else if ($cekUser['aktif'] == 1) {
                Yii::$app->session->setFlash('error', "Akun ini sedang login");
                return $this->render('login', [
                            'model' => $model
                ]);
            }
            else{

                if ($model->login()) {
                    $cekUser->aktif = 1;
                    if($cekUser->save(false)){
                        Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
                        Yii::$app->session['tglLogin'] = (new \ DateTime())->format('d-m-Y');
                        Yii::$app->session['waktuLogin'] = (new \ DateTime())->format('H:i:s');
                        Yii::$app->session['ipAdd'] = Yii::$app->getRequest()->getUserIP();
                        $log = new Savelog();
                        $log->save('login berhasil', 'login', '', ''); //pesan, kegiatan, tabel, id dari tabel
                    }
                    
                    return $this->goBack();
                } else {
                    $cookies = Yii::$app->request->cookies;
                    if ($cookies->has('limit')) {
                        $limit = $cookies->getValue('limit') + 1;
                    }

                    $cekUser = User::findOne(['username' => $model->username]);
                    if (!empty($cekUser['username'])) {
                        if ($cekUser['status'] == 0) {
                            Yii::$app->session->setFlash('error', "Untuk sementara Anda tidak dapat melakukan proses login, silahkan hubungi Support kami.");
                        }
                    }
                    if ($limit >= 3) {

                        if (!empty($cekUser['username'])) {
                            $updateUser = "update user set status='0' where username='$model->username'";
                            $query = Yii::$app->db->createCommand($updateUser);
                            $query->execute();
                        }
                        Yii::$app->session->setFlash('error', "Untuk sementara Anda tidak dapat melakukan proses login, silahkan hubungi Support kami.");
                        $cookies = Yii::$app->response->cookies;
                        $cookies->remove('limit');
                        unset($cookies['limit']);
                    } else {
                        $cookies = Yii::$app->response->cookies;

                        $cookies->add(new \yii\web\Cookie([
                            'name' => 'limit',
                            'value' => $limit,
                        ]));
                    }
                    $news = new News();
                    $news = $news->find()->select(['*', 'day(publish_at) as tgl', 'month(publish_at) as bln', 'year(publish_at) as thn'])->orderBy(['id' => SORT_DESC])->all();
                    return $this->render('login', [
                                'model' => $model,
                                'limit' => $limit,
                                'message' => $message,
                                'news' => $news
                    ]);
                }
            }// cek user aktiv
        } else {
            $news = new News();
            $news = $news->find()->select(['*', 'day(publish_at) as tgl', 'month(publish_at) as bln', 'year(publish_at) as thn'])->orderBy(['id' => SORT_DESC])->all();
            //$cookies->remove('language');
            return $this->render('login', [
                        'model' => $model,
                        'limit' => $limit,
                        'message' => $message,
                        'news' => $news
            ]);
        }
    }
    public function actionLogout() {
        $cookies = Yii::$app->response->cookies;
        // $log = new Savelog();
        // $log->save('logout berhasil', 'logout', '', '');
        
        // if($log->save('logout berhasil', 'logout', '', '')){ //pesan, kegiatan, tabel, id dari tabel
        //     Yii::$app->user->logout();
        //     unset($cookies['limit']);
        //     Yii::$app->session->destroy();
        // }
		
		$id = Yii::$app->user->identity->id;
        $cekUser = User::find()->where(['id' => $id])->one();
        $cekUser->aktif = 0;
        if($cekUser->save(false)){
            $cookies = Yii::$app->response->cookies;
            $log = new Savelog();
            $log->save('logout berhasil', 'logout', '', ''); //pesan, kegiatan, tabel, id dari tabel
            Yii::$app->user->logout();
            unset($cookies['limit']);
            Yii::$app->session->destroy();
            return $this->redirect(['site/login','pesan'=>'uji']);
        }
		/*
        $log = new Savelog();
        $log->save('logout berhasil', 'logout', '', ''); //pesan, kegiatan, tabel, id dari tabel
        Yii::$app->user->logout();
            unset($cookies['limit']);
            Yii::$app->session->destroy();
        return $this->redirect(['site/login']);*/
    }

    public function actionLout() {
        $cookies = Yii::$app->response->cookies;
        Yii::$app->user->logout();
        unset($cookies['limit']);
        Yii::$app->session->destroy();

        return $this->redirect(['site/login']);
    }
    
    public function actionHome() {
        $RefSubUnit = RefSubUnit::find()->all();
        
        $this->layout = 'main-front';
        return $this->render('home', ['RefSubUnit' => $RefSubUnit]);
    }
    
    public function actionContact() {
        
        $this->layout = 'main-front';
        return $this->render('contact');
    }

    public function actionResetPassword($user, $passbaru) {
        
            $user = $this->getUser($user);
            $user->setPassword($passbaru);
            return $user->save(false);
       
    }

    protected function getUser($user) {
        $_user = \common\models\User::findByUsername($user);
        return $_user;
    }
    
}
