<?php 

namespace emusrenbang\controllers;

use Yii;
use app\models\TaPaguUnit;
use app\models\TaBelanja;
use app\models\TaBelanjaRinc;
use app\models\TaBelanjaRincSub;
use app\models\TaBelanjaSearch;
use app\models\RefKegiatanSkpdSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\RefProgram;
use app\models\RefKegiatan;
use app\models\RefRek1;
use app\models\RefRek2;
use app\models\RefRek3;
use app\models\RefRek4;
use app\models\RefRek5;
use app\models\Referensi;
use common\models\TaKegiatan;
use common\models\TaSubUnit;
/**
 * TaBelanjaController implements the CRUD actions for TaBelanja model.
 */
?>
<?php 
class TaBelanjaController extends Controller
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
     * Lists all TaBelanja models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaBelanjaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionList()
    {
    	// $urusan=Yii::$app->user->identity->id_urusan;
    	// $bidang=Yii::$app->user->identity->id_bidang;
    	// $model= RefProgram::find()->select('Ref_Program.*')->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang])->all();
    	// return $this->render('list', [
    	// 	'model' => $model,
    	// ]);
        $tahun    = date('Y');
        $model=new TaKegiatan();

        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $paguUnit = TaPaguUnit::find()->where([
            'Tahun'     =>'2016',
            'Kd_Urusan' =>$urusan,
            'Kd_Bidang' =>$bidang,
            'Kd_Unit'   =>$unit
        ])->one();

        $queryPP="SELECT sum(pagu) as sisa FROM Ta_Pagu_Program WHERE
        Tahun='$tahun' and
        Kd_Urusan='$urusan' and
        Kd_Bidang='$bidang' and
        Kd_Unit='$unit'
        ";
        $paguProgram=Yii::$app->db->createCommand($queryPP)->queryOne();

        $valueUnit=isset($paguUnit) ? $paguUnit->pagu : 0;
        $valueProgram=isset($paguProgram) ? $paguProgram['sisa'] : 0;
        $paguSisa=$valueUnit-$valueProgram;

        $searchModel = new RefKegiatanSkpdSearch();
        $ref=new Referensi;
        $dataProvider = $searchModel->searchProgram(Yii::$app->request->queryParams);
        return $this->render('list', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'ref'           => $ref,
            'paguUnit'      => isset($paguUnit) ? $paguUnit->pagu : 0,
            'paguSisa'      => $paguSisa,
            'mod'			=> $model
        ]);
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

    public function actionProgramadmin($urusan,$bidang,$unit)
    {
        $tahun    = date('Y');
        $urusan   = $urusan;
        $bidang   = $bidang;
        $unit     = $unit;

        $paguUnit = TaPaguUnit::find()->where([
            'Tahun'     =>'2016',
            'Kd_Urusan' =>$urusan,
            'Kd_Bidang' =>$bidang,
            'Kd_Unit'   =>$unit
        ])->one();

        $queryPP="SELECT sum(pagu) as sisa FROM Ta_Pagu_Program WHERE
        Tahun='$tahun' and
        Kd_Urusan='$urusan' and
        Kd_Bidang='$bidang' and
        Kd_Unit='$unit'
        ";
        $paguProgram=Yii::$app->db->createCommand($queryPP)->queryOne();

        $valueUnit=isset($paguUnit) ? $paguUnit->pagu : 0;
        $valueProgram=isset($paguProgram) ? $paguProgram['sisa'] : 0;
        $paguSisa=$valueUnit-$valueProgram;

        $searchModel = new RefKegiatanSkpdSearch();
        $ref=new Referensi;
        $dataProvider = $searchModel->searchProgramAdmin($urusan,$bidang,Yii::$app->request->queryParams);
        return $this->render('listAdmin', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'ref'           => $ref,
            'paguUnit'      => isset($paguUnit) ? $paguUnit->pagu : 0,
            'paguSisa'      => $paguSisa,
            'urusan'        => $urusan,
            'bidang'        => $bidang,
            'unit'          => $unit
        ]);
    }

    public function actionListkegiatan($id)
    {

        $searchModel = new RefKegiatanSkpdSearch();
        $ref=new Referensi;
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $modelProgram = RefProgram::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])->one();

        $dataProvider = $searchModel->searchKegiatan($id,Yii::$app->request->queryParams);

        return $this->render('listkegiatan', [
            'searchModel'   => $searchModel,
            'dataProvider'  => $dataProvider,
            'ref'           => $ref,
            'ketProgram'    => $modelProgram['Ket_Program'],
            'KdProg'        => $modelProgram['Kd_Prog']
        ]);
    }

    public function actionListbelanja($Kd_Prog, $Kd_Keg)
    {
        $unitskpd = Yii::$app->levelcomponent->getUnit();

        $model = TaKegiatan::findone([
                'Kd_Urusan'=> $unitskpd['Kd_Urusan'], 
                'Kd_Bidang'=> $unitskpd['Kd_Bidang'], 
                'Kd_Prog'=> $Kd_Prog, 
                'Kd_Keg'=> $Kd_Keg,
                'Kd_Unit'=> $unitskpd['Kd_Unit'], 
                'Kd_Sub'=> $unitskpd['Kd_Sub_Unit'], 
            ]);

        $modelUnit= TaSubUnit::find()->where($this->Unit())
                                    ->all();

    	return $this->render('listbelanja', [
            'model' => $model,
            'modelUnit' => $modelUnit,
    	]);
    }

    public function actionListbelanja2($id, $idkeg)
    {
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $tahun=date('Y');
        $model= TaBelanja::find()
            ->select('Ta_Belanja.*, Ref_Rek_5.Nm_Rek_5')
            ->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja.Kd_Rek_5
                and Ref_Rek_5.Kd_Rek_1=Ta_Belanja.Kd_Rek_1
                and Ref_Rek_5.Kd_Rek_2=Ta_Belanja.Kd_Rek_2
                and Ref_Rek_5.Kd_Rek_3=Ta_Belanja.Kd_Rek_3
                and Ref_Rek_5.Kd_Rek_4=Ta_Belanja.Kd_Rek_4')
            ->where([
                'Tahun'     => $tahun,
                'Kd_Urusan' => $urusan,
                'Kd_Bidang' => $bidang,
                'Kd_Unit'   => $unit,
                'Kd_Sub'    => $sub,
                'Kd_Prog'   => $id,
                'Kd_Keg'    => $idkeg
            ])
            ->all();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

        return $this->render('listbelanja', [
            'model' => $model,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'id' => $id,
            'idkeg' => $idkeg,
            'KdProg' => $KdProg
        ]);
    }

    public function actionListbelanjarinc($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5)
    {
    	$cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

    	$tahun=date('Y');
    	$model= TaBelanjaRinc::find()
    		->select('Ta_Belanja_Rinc.*, Ref_Rek_5.Nm_Rek_5')
    		->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja_Rinc.Kd_Rek_5
    			and Ref_Rek_5.Kd_Rek_1=Ta_Belanja_Rinc.Kd_Rek_1
    			and Ref_Rek_5.Kd_Rek_2=Ta_Belanja_Rinc.Kd_Rek_2
    			and Ref_Rek_5.Kd_Rek_3=Ta_Belanja_Rinc.Kd_Rek_3
    			and Ref_Rek_5.Kd_Rek_4=Ta_Belanja_Rinc.Kd_Rek_4')
    		->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan,
    			'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
    			'Ta_Belanja_Rinc.Kd_Rek_1'=>$rek1, 'Ta_Belanja_Rinc.Kd_Rek_2'=>$rek2, 'Ta_Belanja_Rinc.Kd_Rek_3'=>$rek3,
    			'Ta_Belanja_Rinc.Kd_Rek_4'=>$rek4, 'Ta_Belanja_Rinc.Kd_Rek_5'=>$rek5])
    		->all();
    	$modelBelanja = TaBelanja::find()
    		->select('Ta_Belanja.*, Ref_Rek_5.Nm_Rek_5')
    		->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja.Kd_Rek_5
    			and Ref_Rek_5.Kd_Rek_1=Ta_Belanja.Kd_Rek_1
    			and Ref_Rek_5.Kd_Rek_2=Ta_Belanja.Kd_Rek_2
    			and Ref_Rek_5.Kd_Rek_3=Ta_Belanja.Kd_Rek_3
    			and Ref_Rek_5.Kd_Rek_4=Ta_Belanja.Kd_Rek_4')
    		->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan,
    			'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
    			'Ta_Belanja.Kd_Rek_1'=>$rek1, 'Ta_Belanja.Kd_Rek_2'=>$rek2, 'Ta_Belanja.Kd_Rek_3'=>$rek3,
    			'Ta_Belanja.Kd_Rek_4'=>$rek4, 'Ta_Belanja.Kd_Rek_5'=>$rek5])
    		->one();
    	$modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('listbelanjarinc', [
    		'model' => $model,
    		'ketProgram' => $ketProgram,
            'modelBelanja' => $modelBelanja,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
            'id' => $id,
            'idkeg' => $idkeg,
            'rek1' => $rek1,
            'rek2' => $rek2,
            'rek3' => $rek3,
            'rek4' => $rek4,
            'rek5' => $rek5
    	]);
    }

    public function actionListbelanjarincsub($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5, $norinc)
    {
    	$cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }
    	$tahun=date('Y');
    	$model= TaBelanjaRincSub::find()
    		->select('Ta_Belanja_Rinc_Sub.*, Ref_Rek_5.Nm_Rek_5')
    		->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja_Rinc_Sub.Kd_Rek_5
    			and Ref_Rek_5.Kd_Rek_1=Ta_Belanja_Rinc_Sub.Kd_Rek_1
    			and Ref_Rek_5.Kd_Rek_2=Ta_Belanja_Rinc_Sub.Kd_Rek_2
    			and Ref_Rek_5.Kd_Rek_3=Ta_Belanja_Rinc_Sub.Kd_Rek_3
    			and Ref_Rek_5.Kd_Rek_4=Ta_Belanja_Rinc_Sub.Kd_Rek_4')
    		->where([
                'Tahun'=>$tahun,
                'Kd_Urusan'=>$urusan,
    			'Kd_Bidang'=>$bidang,
                'Kd_Prog'=>$id,
                'Kd_Keg'=>$idkeg,
    			'Ta_Belanja_Rinc_Sub.Kd_Rek_1'=>$rek1,
                'Ta_Belanja_Rinc_Sub.Kd_Rek_2'=>$rek2,
    			'Ta_Belanja_Rinc_Sub.Kd_Rek_3'=>$rek3,
    			'Ta_Belanja_Rinc_Sub.Kd_Rek_4'=>$rek4,
                'Ta_Belanja_Rinc_Sub.Kd_Rek_5'=>$rek5,
                'Ta_Belanja_Rinc_Sub.No_Rinc'=>$norinc
            ])
    		->all();
    	$modelBelanja = TaBelanjaRinc::find()
    		->select('Ta_Belanja_Rinc.*, Ref_Rek_5.Nm_Rek_5')
    		->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja_Rinc.Kd_Rek_5
    			and Ref_Rek_5.Kd_Rek_1=Ta_Belanja_Rinc.Kd_Rek_1
    			and Ref_Rek_5.Kd_Rek_2=Ta_Belanja_Rinc.Kd_Rek_2
    			and Ref_Rek_5.Kd_Rek_3=Ta_Belanja_Rinc.Kd_Rek_3
    			and Ref_Rek_5.Kd_Rek_4=Ta_Belanja_Rinc.Kd_Rek_4')
    		->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan,
    			'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
    			'Ta_Belanja_Rinc.Kd_Rek_1'=>$rek1, 'Ta_Belanja_Rinc.Kd_Rek_2'=>$rek2, 'Ta_Belanja_Rinc.Kd_Rek_3'=>$rek3,
    			'Ta_Belanja_Rinc.Kd_Rek_4'=>$rek4, 'Ta_Belanja_Rinc.Kd_Rek_5'=>$rek5, 'No_Rinc'=>$norinc])
    		->one();
    	$modelProgram = RefProgram::find()
    		->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
    		->one();
    	$ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

    	$modelKegiatan = RefKegiatan::find()
    		->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
    		->one();
    	$ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('listbelanjarincsub', [
    		'model' => $model,
    		'modelBelanja' => $modelBelanja,
    		'ketProgram' => $ketProgram,
    		'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
    		'rek2' => $rek2,
    		'rek3' => $rek3,
    		'rek4' => $rek4,
    		'rek5' => $rek5,
    		'norinc' => $norinc,
    	]);
    }

    public function actionTambahRek($id, $idkeg)
    {
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }
        $tahun=date('Y');

        $model  = new TaBelanja;

        $modelRek1 = RefRek1::find()->where(['Kd_Rek_1'=>5])->all();
        $modelRek2 = RefRek2::find()->where(['Kd_Rek_1'=>5])->all();

        foreach($modelRek2 as $r2){
            $rek2A[$r2['Kd_Rek_2']]=$r2['Nm_Rek_2'];
        }

        if ($model->load(Yii::$app->request->post())){
            try{
                $model->Tahun     = $tahun;
                $model->Kd_Urusan = $urusan;
                $model->Kd_Bidang = $bidang;
                $model->Kd_Unit   = $unit;
                $model->Kd_Sub    = $sub;
                $model->Kd_Prog   = $id;
                $model->Kd_Keg    = $idkeg;
                $model->Kd_Rek_1  = 5;
                $model->save();
                Yii::$app->session->addFlash('success', "Kode Rekening Berhasil Disimpan");
                return $this->redirect(['listbelanja', 'id'=>$id, 'idkeg'=>$idkeg]);
            }catch(Exception $e){
                Yii::$app->session->addFlash('success', "Kode Rekening Tidak Berhasil Disimpan");
            }
        }

        $modelProgram = RefProgram::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])->one();
        $ketProgram = $modelProgram['Ket_Program'];

        $modelKegiatan = RefKegiatan::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

        return $this->render('rincian', [
            'model'         => $model,
            'modelRek1'     => $modelRek1,
            'KdProg'        => $id,
            'rek2A'         => $rek2A,
            'rek3A'         => array(),
            'rek4A'         => array(),
            'rek5A'         => array(),
            'ketProgram'    => $ketProgram,
            'ketKegiatan'   => $ketKegiatan,
            'idkeg'         => $idkeg
        ]);
    }

    public function actionUpdateRek($id, $idkeg, $rek1, $rek2, $rek3, $rek4,$rek5)
    {

        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }
        $tahun=date('Y');

        $model = TaBelanja::find()->where([
            'Tahun'=>$tahun,
            'Kd_Urusan'=>$urusan,
            'Kd_Bidang'=>$bidang,
            'Kd_Unit'=>$unit,
            'Kd_Sub'=>$sub,
            'Kd_Prog'=>$id,
            'Kd_Keg'=>$idkeg,
            'Kd_Rek_1'=>$rek1,
            'Kd_Rek_2'=>$rek2,
            'Kd_Rek_3'=>$rek3,
            'Kd_Rek_4'=>$rek4,
            'Kd_Rek_5'=>$rek5
        ])->one();

        if ($model->load(Yii::$app->request->post())){
            try{
                $model->Tahun     = $tahun;
                $model->Kd_Urusan = $urusan;
                $model->Kd_Bidang = $bidang;
                $model->Kd_Unit   = $unit;
                $model->Kd_Sub    = $sub;
                $model->Kd_Prog   = $id;
                $model->Kd_Keg    = $idkeg;
                $model->Kd_Rek_1  = 5;
                $model->save();
                Yii::$app->session->addFlash('success', "Kode Rekening Berhasil DiUbah");
                return $this->redirect(['listbelanja', 'id'=>$id, 'idkeg'=>$idkeg]);
            }catch(Exception $e){
                Yii::$app->session->addFlash('success', "Kode Rekening Tidak Berhasil DiUbah");
            }
        }

        $modelRek1 = RefRek1::find()->where(['Kd_Rek_1'=>5])->all();
        $modelRek2 = RefRek2::find()->where(['Kd_Rek_1'=>5])->all();

        $modelRek3 = RefRek3::find()->where([
            'Kd_Rek_1'=>5,
            'Kd_Rek_2'=>$rek2
        ])->all();

        $modelRek4 = RefRek4::find()->where([
            'Kd_Rek_1'=>5,
            'Kd_Rek_2'=>$rek2,
            'Kd_Rek_3'=>$rek3
        ])->all();

        $modelRek5 = RefRek5::find()->where([
            'Kd_Rek_1'=>5,
            'Kd_Rek_2'=>$rek2,
            'Kd_Rek_3'=>$rek3,
            'Kd_Rek_4'=>$rek4
        ])->all();

        foreach($modelRek2 as $row){
            $rek2A[$row['Kd_Rek_2']]=$row['Nm_Rek_2'];
        }

        foreach($modelRek3 as $row){
            $rek3A[$row['Kd_Rek_3']]=$row['Nm_Rek_3'];
        }

        foreach($modelRek4 as $row){
            $rek4A[$row['Kd_Rek_4']]=$row['Nm_Rek_4'];
        }

        foreach($modelRek5 as $row){
            $rek5A[$row['Kd_Rek_5']]=$row['Nm_Rek_5'];
        }

        $modelProgram = RefProgram::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])->one();
        $ketProgram = $modelProgram['Ket_Program'];

        $modelKegiatan = RefKegiatan::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

        return $this->render('rincian', [
            'model'         => $model,
            'modelRek1'     => $modelRek1,
            'KdProg'        => $id,
            'rek2A'         => $rek2A,
            'rek3A'         => $rek3A,
            'rek4A'         => $rek4A,
            'rek5A'         => $rek5A,
            'ketProgram'    => $ketProgram,
            'ketKegiatan'   => $ketKegiatan,
            'idkeg'         => $idkeg
        ]);
    }

    public function actionTambahrinc($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5)
    {
    	$cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }
    	$tahun=date('Y');
    	$model = new TaBelanjaRinc;

    	if ($model->load(Yii::$app->request->post())){
    		$model->Tahun=$tahun;
    		$model->Kd_Urusan=$urusan;
    		$model->Kd_Bidang=$bidang;
    		$model->Kd_Unit=$unit;
    		$model->Kd_Sub=$sub;
    		$model->Kd_Prog=$id;
    		$model->Kd_Keg=$idkeg;
    		$model->Kd_Rek_1=$rek1;
    		$model->Kd_Rek_2=$rek2;
    		$model->Kd_Rek_3=$rek3;
    		$model->Kd_Rek_4=$rek4;
    		$model->Kd_Rek_5=$rek5;

    		if($model->save()){
    			$this->redirect(['listbelanjarinc', 'id'=>$id, 'idkeg'=>$idkeg,
    				'rek1'=>$rek1, 'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4,
    				'rek5'=>$rek5]);
    		}
    	}

        $modelBelanja = TaBelanja::find()
            ->select('Ta_Belanja.*, Ref_Rek_5.Nm_Rek_5')
            ->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja.Kd_Rek_5
                and Ref_Rek_5.Kd_Rek_1=Ta_Belanja.Kd_Rek_1
                and Ref_Rek_5.Kd_Rek_2=Ta_Belanja.Kd_Rek_2
                and Ref_Rek_5.Kd_Rek_3=Ta_Belanja.Kd_Rek_3
                and Ref_Rek_5.Kd_Rek_4=Ta_Belanja.Kd_Rek_4')
            ->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan,
                'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
                'Ta_Belanja.Kd_Rek_1'=>$rek1, 'Ta_Belanja.Kd_Rek_2'=>$rek2, 'Ta_Belanja.Kd_Rek_3'=>$rek3,
                'Ta_Belanja.Kd_Rek_4'=>$rek4, 'Ta_Belanja.Kd_Rek_5'=>$rek5])
            ->one();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('tambahrinc', [
    		'model' => $model,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
    		'rek2' => $rek2,
    		'rek3' => $rek3,
    		'rek4' => $rek4,
    		'rek5' => $rek5,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
            'modelBelanja' => $modelBelanja
    	]);
    }

    public function actionUpdaterinc($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5,$norinc)
    {

        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $tahun=date('Y');

        $model = TaBelanjaRinc::find()->where([
            'Tahun'=>$tahun,
            'Kd_Urusan'=>$urusan,
            'Kd_Bidang'=>$bidang,
            'Kd_Unit'=>$unit,
            'Kd_Sub'=>$sub,
            'Kd_Prog'=>$id,
            'Kd_Keg'=>$idkeg,
            'Kd_Rek_1'=>$rek1,
             'Kd_Rek_2'=>$rek2,
              'Kd_Rek_3'=>$rek3,
               'Kd_Rek_4'=>$rek4,
            'Kd_Rek_5'=>$rek5,
             'No_Rinc'=>$norinc])->one();

        if ($model->load(Yii::$app->request->post())){
            try{
                $model->Tahun=$tahun;
                $model->Kd_Urusan=$urusan;
                $model->Kd_Bidang=$bidang;
                $model->Kd_Unit=$unit;
                $model->Kd_Sub=$sub;
                $model->Kd_Prog=$id;
                $model->Kd_Keg=$idkeg;
                $model->Kd_Rek_1=$rek1;
                $model->Kd_Rek_2=$rek2;
                $model->Kd_Rek_3=$rek3;
                $model->Kd_Rek_4=$rek4;
                $model->Kd_Rek_5=$rek5;
                $model->save();
                Yii::$app->session->addFlash('success', "Data Berhasil Ubah");
            }catch(Exception $e){
                Yii::$app->session->addFlash('error', "Data Tidak Berhasil Ubah");
            }
            return $this->redirect(['listbelanjarinc', 'id'=>$id, 'idkeg'=>$idkeg,
                    'rek1'=>$rek1, 'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4,
                    'rek5'=>$rek5]);
        }

        $modelBelanja = TaBelanja::find()
            ->select('Ta_Belanja.*, Ref_Rek_5.Nm_Rek_5')
            ->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja.Kd_Rek_5
                and Ref_Rek_5.Kd_Rek_1=Ta_Belanja.Kd_Rek_1
                and Ref_Rek_5.Kd_Rek_2=Ta_Belanja.Kd_Rek_2
                and Ref_Rek_5.Kd_Rek_3=Ta_Belanja.Kd_Rek_3
                and Ref_Rek_5.Kd_Rek_4=Ta_Belanja.Kd_Rek_4')
            ->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan,
                'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
                'Ta_Belanja.Kd_Rek_1'=>$rek1, 'Ta_Belanja.Kd_Rek_2'=>$rek2, 'Ta_Belanja.Kd_Rek_3'=>$rek3,
                'Ta_Belanja.Kd_Rek_4'=>$rek4, 'Ta_Belanja.Kd_Rek_5'=>$rek5])
            ->one();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

        return $this->render('tambahrinc', [
            'model' => $model,
            'id' => $id,
            'idkeg' => $idkeg,
            'rek1' => $rek1,
            'rek2' => $rek2,
            'rek3' => $rek3,
            'rek4' => $rek4,
            'rek5' => $rek5,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
            'modelBelanja' => $modelBelanja
        ]);
    }


    public function actionDeleterinc($Tahun,$id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5,$norinc)
    {
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $sql1="delete from Ta_Belanja_Rinc_Sub WHERE
            Tahun       ='$Tahun' and
            Kd_Urusan   ='$urusan' and
            Kd_Bidang   ='$bidang' and
            Kd_Unit     ='$unit' and
            Kd_Sub      ='$sub' and
            Kd_Prog     ='$id' and
            Kd_Keg      ='$idkeg' and
            Kd_Rek_1    ='$rek1' and
            Kd_Rek_2    ='$rek2' and
            Kd_Rek_3    ='$rek3' and
            Kd_Rek_4    ='$rek4' and
            Kd_Rek_5    ='$rek5' and
            No_Rinc     ='$norinc'
        ";


        $sql2="delete from Ta_Belanja_Rinc WHERE
            Tahun       ='$Tahun' and
            Kd_Urusan   ='$urusan' and
            Kd_Bidang   ='$bidang' and
            Kd_Unit     ='$unit' and
            Kd_Sub      ='$sub' and
            Kd_Prog     ='$id' and
            Kd_Keg      ='$idkeg' and
            Kd_Rek_1    ='$rek1' and
            Kd_Rek_2    ='$rek2' and
            Kd_Rek_3    ='$rek3' and
            Kd_Rek_4    ='$rek4' and
            Kd_Rek_5    ='$rek5' and
            No_Rinc     ='$norinc'
        ";

        $connection = Yii::$app->db;
        try
        {
            $transaction=$connection->beginTransaction();
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            $transaction->commit();
            Yii::$app->session->addFlash('success', "Data Berhasil Hapus");
        }catch(Exception $e){
            $transaction->rollBack();
            Yii::$app->session->addFlash('error', "Data Tidak Berhasil Hapus");
        }

        return $this->redirect(['listbelanjarinc',
            'id'=>$id,
            'idkeg'=>$idkeg,
            'rek1'=>$rek1,
            'rek2'=>$rek2,
            'rek3'=>$rek3,
            'rek4'=>$rek4,
            'rek5'=>$rek5
        ]);
    }

    public function actionTambahrincsub($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5, $norinc)
    {
    	$this->layout="modal";
    	$tahun=date('Y');
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $model = new TaBelanjaRincSub;

    	if ($model->load(Yii::$app->request->post())){
    		$model->Tahun=$tahun;
    		$model->Kd_Urusan=$urusan;
    		$model->Kd_Bidang=$bidang;
    		$model->Kd_Unit=$unit;
    		$model->Kd_Sub=$sub;
    		$model->Kd_Prog=$id;
    		$model->Kd_Keg=$idkeg;
    		$model->Kd_Rek_1=$rek1;
    		$model->Kd_Rek_2=$rek2;
    		$model->Kd_Rek_3=$rek3;
    		$model->Kd_Rek_4=$rek4;
    		$model->Kd_Rek_5=$rek5;
    		$model->No_Rinc=$norinc;

    		if($model->save()){
    			$this->redirect(['listbelanjarincsub', 'id'=>$id, 'idkeg'=>$idkeg,
    				'rek1'=>$rek1, 'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4,
    				'rek5'=>$rek5, 'norinc'=>$norinc]);
    		}
    	}

        $modelBelanja = TaBelanjaRinc::find()
            ->select('Ta_Belanja_Rinc.*, Ref_Rek_5.Nm_Rek_5')
            ->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja_Rinc.Kd_Rek_5
                and Ref_Rek_5.Kd_Rek_1=Ta_Belanja_Rinc.Kd_Rek_1
                and Ref_Rek_5.Kd_Rek_2=Ta_Belanja_Rinc.Kd_Rek_2
                and Ref_Rek_5.Kd_Rek_3=Ta_Belanja_Rinc.Kd_Rek_3
                and Ref_Rek_5.Kd_Rek_4=Ta_Belanja_Rinc.Kd_Rek_4')
            ->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan,
                'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
                'Ta_Belanja_Rinc.Kd_Rek_1'=>$rek1, 'Ta_Belanja_Rinc.Kd_Rek_2'=>$rek2, 'Ta_Belanja_Rinc.Kd_Rek_3'=>$rek3,
                'Ta_Belanja_Rinc.Kd_Rek_4'=>$rek4, 'Ta_Belanja_Rinc.Kd_Rek_5'=>$rek5, 'No_Rinc'=>$norinc])
            ->one();
        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('tambahrincsub', [
    		'model' => $model,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
    		'rek2' => $rek2,
    		'rek3' => $rek3,
    		'rek4' => $rek4,
    		'rek5' => $rek5,
    		'norinc' => $norinc,
            'modelBelanja' => $modelBelanja,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'idkeg' => $idkeg,
            'KdProg' => $KdProg
    	]);
    }

    public function actionUpdaterincsub($id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5, $norinc, $noid)
    {
		$this->layout="modal";

    	$cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

    	$tahun=date('Y');
    	$model = TaBelanjaRincSub::find()->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang,
    		'Kd_Unit'=>$unit, 'Kd_Sub'=>$sub, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
    		'Kd_Rek_1'=>$rek1, 'Kd_Rek_2'=>$rek2, 'Kd_Rek_3'=>$rek3, 'Kd_Rek_4'=>$rek4,
    		'Kd_Rek_5'=>$rek5, 'No_Rinc'=>$norinc, 'No_Id'=>$noid])->one();


    	if ($model->load(Yii::$app->request->post())){
    		try{
                $model->Tahun=$tahun;
        		$model->Kd_Urusan=$urusan;
        		$model->Kd_Bidang=$bidang;
        		$model->Kd_Unit=$unit;
        		$model->Kd_Sub=$sub;
        		$model->Kd_Prog=$id;
        		$model->Kd_Keg=$idkeg;
        		$model->Kd_Rek_1=$rek1;
        		$model->Kd_Rek_2=$rek2;
        		$model->Kd_Rek_3=$rek3;
        		$model->Kd_Rek_4=$rek4;
        		$model->Kd_Rek_5=$rek5;
        		$model->No_Rinc=$norinc;
                $model->save();
                Yii::$app->session->addFlash('success', "Data Berhasil Ubah");
            }catch(Exception $e){
                Yii::$app->session->addFlash('error', "Data Tidak Berhasil Ubah");
            }
            return $this->redirect(['listbelanjarincsub', 'id'=>$id, 'idkeg'=>$idkeg,
                    'rek1'=>$rek1, 'rek2'=>$rek2, 'rek3'=>$rek3, 'rek4'=>$rek4,
                    'rek5'=>$rek5, 'norinc'=>$norinc]);
    	}

         $modelBelanja = TaBelanjaRinc::find()
            ->select('Ta_Belanja_Rinc.*, Ref_Rek_5.Nm_Rek_5')
            ->leftJoin('Ref_Rek_5', 'Ref_Rek_5.Kd_Rek_5=Ta_Belanja_Rinc.Kd_Rek_5
                and Ref_Rek_5.Kd_Rek_1=Ta_Belanja_Rinc.Kd_Rek_1
                and Ref_Rek_5.Kd_Rek_2=Ta_Belanja_Rinc.Kd_Rek_2
                and Ref_Rek_5.Kd_Rek_3=Ta_Belanja_Rinc.Kd_Rek_3
                and Ref_Rek_5.Kd_Rek_4=Ta_Belanja_Rinc.Kd_Rek_4')
            ->where(['Tahun'=>$tahun, 'Kd_Urusan'=>$urusan,
                'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg,
                'Ta_Belanja_Rinc.Kd_Rek_1'=>$rek1, 'Ta_Belanja_Rinc.Kd_Rek_2'=>$rek2, 'Ta_Belanja_Rinc.Kd_Rek_3'=>$rek3,
                'Ta_Belanja_Rinc.Kd_Rek_4'=>$rek4, 'Ta_Belanja_Rinc.Kd_Rek_5'=>$rek5, 'No_Rinc'=>$norinc])
            ->one();
        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('tambahrincsub', [
    		'model' => $model,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
    		'rek2' => $rek2,
    		'rek3' => $rek3,
    		'rek4' => $rek4,
    		'rek5' => $rek5,
    		'norinc' => $norinc,
            'modelBelanja' => $modelBelanja,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'idkeg' => $idkeg,
            'KdProg' => $KdProg
    	]);
    }

    public function actionDeleterincsub($Tahun,$rek1, $rek2, $rek3, $rek4, $rek5, $Kd_Prog, $Kd_Keg, $norinc, $noid)
    {
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $sql="delete from Ta_Belanja_Rinc_Sub WHERE
                Tahun       ='$Tahun' and
                Kd_Urusan   ='$urusan' and
                Kd_Bidang   ='$bidang' and
                Kd_Unit     ='$unit' and
                Kd_Sub      ='$sub' and
                Kd_Prog     ='$Kd_Prog' and
                Kd_Keg      ='$Kd_Keg' and
                Kd_Rek_1    ='$rek1' and
                Kd_Rek_2    ='$rek2' and
                Kd_Rek_3    ='$rek3' and
                Kd_Rek_4    ='$rek4' and
                Kd_Rek_5    ='$rek5' and
                No_Rinc     ='$norinc' and
                No_ID       ='$noid'
            ";

        $connection = Yii::$app->db;
        try
        {
            $transaction=$connection->beginTransaction();
            $connection->createCommand($sql)->execute();
            $transaction->commit();
            Yii::$app->session->addFlash('success', "Data Berhasil Hapus");
        }catch(Exception $e){
            $transaction->rollBack();
            Yii::$app->session->addFlash('error', "Data Tidak Berhasil Hapus");
        }

        return $this->redirect(['listbelanjarincsub',
            'id'=>$Kd_Prog,
            'idkeg'=>$Kd_Keg,
            'rek1'=>$rek1,
            'rek2'=>$rek2,
            'rek3'=>$rek3,
            'rek4'=>$rek4,
            'rek5'=>$rek5,
            'norinc'=>$norinc
        ]);
    }

    public function actionKelompok($id, $idkeg, $rek1)
    {
    	$cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }
    	$tahun=date('Y');
    	$model = RefRek2::find()
    		->where(['Kd_Rek_1'=>$rek1, 'Nm_Rek_2'=>'Belanja Langsung'])
    		->all();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('kelompok', [
    		'model' => $model,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
            'idkeg' => $idkeg,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
    	]);
    }

    public function actionJenis($id, $idkeg, $rek1, $rek2)
    {
    	$cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }
    	$tahun=date('Y');
    	$model = RefRek3::find()
    		->where(['Kd_Rek_1'=>$rek1, 'Kd_Rek_2'=>$rek2])
    		->all();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];
    	return $this->render('jenis', [
    		'model' => $model,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
    		'rek2' => $rek2,
            'idkeg' => $idkeg,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
    	]);
    }

    public function actionObyek($id, $idkeg, $rek1, $rek2, $rek3)
    {
    	$cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }
    	$tahun=date('Y');
    	$model = RefRek4::find()
    		->where(['Kd_Rek_1'=>$rek1, 'Kd_Rek_2'=>$rek2, 'Kd_Rek_3'=>$rek3])
    		->all();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('obyek', [
    		'model' => $model,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
    		'rek2' => $rek2,
    		'rek3' => $rek3,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
    	]);
    }

    public function actionRincian($id, $idkeg, $rek1, $rek2, $rek3, $rek4)
    {
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

    	$tahun=date('Y');
    	$mod = new TaBelanja();
    	$model = RefRek5::find()
    		->where(['Kd_Rek_1'=>$rek1, 'Kd_Rek_2'=>$rek2, 'Kd_Rek_3'=>$rek3, 'Kd_Rek_4'=>$rek4])
    		->all();
    	if ($mod->load(Yii::$app->request->post())){
            try {
                $mod->Tahun=$tahun;
                $mod->Kd_Urusan=$urusan;
                $mod->Kd_Bidang=$bidang;
                $mod->Kd_Unit=$unit;
                $mod->Kd_Sub=$sub;
                $mod->Kd_Prog=$id;
                $mod->Kd_Keg=$idkeg;
                $mod->Kd_Rek_1=$rek1;
                $mod->Kd_Rek_2=$rek2;
                $mod->Kd_Rek_3=$rek3;
                $mod->Kd_Rek_4=$rek4;
                $mod->save();
                Yii::$app->session->addFlash('success', "Data Berhasil Disimpan");
            }  catch (\yii\db\Exception $e) {
                Yii::$app->session->addFlash('error', "Data Tidak Berhasil Disimpan");
            }
            return $this->redirect(['listbelanja', 'id'=>$id, 'idkeg'=>$idkeg]);
    	}

        $rek4N = RefRek4::find()
            ->where(['Kd_Rek_1'=>$rek1, 'Kd_Rek_2'=>$rek2, 'Kd_Rek_3'=>$rek3, 'Kd_Rek_4'=>$rek4])
            ->one();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    	return $this->render('rincian', [
    		'mod' => $mod,
    		'model' => $model,
    		'id' => $id,
    		'idkeg' => $idkeg,
    		'rek1' => $rek1,
    		'rek2' => $rek2,
    		'rek3' => $rek3,
            'rek4' => $rek4,
    		'rek4N' => $rek4N->Nm_Rek_4,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
            'modelRek1' => null,
            'modelRek2' => null,
            'modelRek3' => null,
            'modelRek4' => null
    	]);
    }

    public function actionDeletebelanja($Tahun,$id, $idkeg, $rek1, $rek2, $rek3, $rek4, $rek5)
    {
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $sql1="delete from Ta_Belanja WHERE
            Tahun       ='$Tahun' and
            Kd_Urusan   ='$urusan' and
            Kd_Bidang   ='$bidang' and
            Kd_Unit     ='$unit' and
            Kd_Sub      ='$sub' and
            Kd_Prog     ='$id' and
            Kd_Keg      ='$idkeg' and
            Kd_Rek_1    ='$rek1' and
            Kd_Rek_2    ='$rek2' and
            Kd_Rek_3    ='$rek3' and
            Kd_Rek_4    ='$rek4' and
            Kd_Rek_5    ='$rek5'
        ";


        $sql2="delete from Ta_Belanja_Rinc WHERE
            Tahun       ='$Tahun' and
            Kd_Urusan   ='$urusan' and
            Kd_Bidang   ='$bidang' and
            Kd_Unit     ='$unit' and
            Kd_Sub      ='$sub' and
            Kd_Prog     ='$id' and
            Kd_Keg      ='$idkeg' and
            Kd_Rek_1    ='$rek1' and
            Kd_Rek_2    ='$rek2' and
            Kd_Rek_3    ='$rek3' and
            Kd_Rek_4    ='$rek4' and
            Kd_Rek_5    ='$rek5'
        ";

        $sql3="delete from Ta_Belanja_Rinc_Sub WHERE
            Tahun       ='$Tahun' and
            Kd_Urusan   ='$urusan' and
            Kd_Bidang   ='$bidang' and
            Kd_Unit     ='$unit' and
            Kd_Sub      ='$sub' and
            Kd_Prog     ='$id' and
            Kd_Keg      ='$idkeg' and
            Kd_Rek_1    ='$rek1' and
            Kd_Rek_2    ='$rek2' and
            Kd_Rek_3    ='$rek3' and
            Kd_Rek_4    ='$rek4' and
            Kd_Rek_5    ='$rek5'
        ";

        $connection = Yii::$app->db;
        try
        {
            $transaction=$connection->beginTransaction();
            $connection->createCommand($sql1)->execute();
            $connection->createCommand($sql2)->execute();
            $connection->createCommand($sql3)->execute();
            $transaction->commit();
            Yii::$app->session->addFlash('success', "Data Berhasil Hapus");
        }catch(Exception $e){
            $transaction->rollBack();
            Yii::$app->session->addFlash('error', "Data Tidak Berhasil Hapus");
        }

        return $this->redirect(['listbelanja', 'id'=>$id, 'idkeg'=>$idkeg]);
    }

    /**
     * Displays a single TaBelanja model.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @return mixed
     */
    public function actionView($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        return $this->render('view', [
            'model' => $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5),
        ]);
    }

    /**
     * Creates a new TaBelanja model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaBelanja();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3, 'Kd_Rek_4' => $model->Kd_Rek_4, 'Kd_Rek_5' => $model->Kd_Rek_5]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaBelanja model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @return mixed
     */
    public function actionUpdate($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        $model = $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Tahun' => $model->Tahun, 'Kd_Urusan' => $model->Kd_Urusan, 'Kd_Bidang' => $model->Kd_Bidang, 'Kd_Unit' => $model->Kd_Unit, 'Kd_Sub' => $model->Kd_Sub, 'Kd_Prog' => $model->Kd_Prog, 'Kd_Keg' => $model->Kd_Keg, 'Kd_Rek_1' => $model->Kd_Rek_1, 'Kd_Rek_2' => $model->Kd_Rek_2, 'Kd_Rek_3' => $model->Kd_Rek_3, 'Kd_Rek_4' => $model->Kd_Rek_4, 'Kd_Rek_5' => $model->Kd_Rek_5]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaBelanja model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @return mixed
     */
    public function actionDelete($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        $this->findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaBelanja model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $Tahun
     * @param integer $Kd_Urusan
     * @param integer $Kd_Bidang
     * @param integer $Kd_Unit
     * @param integer $Kd_Sub
     * @param integer $Kd_Prog
     * @param integer $Kd_Keg
     * @param integer $Kd_Rek_1
     * @param integer $Kd_Rek_2
     * @param integer $Kd_Rek_3
     * @param integer $Kd_Rek_4
     * @param integer $Kd_Rek_5
     * @return TaBelanja the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Tahun, $Kd_Urusan, $Kd_Bidang, $Kd_Unit, $Kd_Sub, $Kd_Prog, $Kd_Keg, $Kd_Rek_1, $Kd_Rek_2, $Kd_Rek_3, $Kd_Rek_4, $Kd_Rek_5)
    {
        if (($model = TaBelanja::findOne(['Tahun' => $Tahun, 'Kd_Urusan' => $Kd_Urusan, 'Kd_Bidang' => $Kd_Bidang, 'Kd_Unit' => $Kd_Unit, 'Kd_Sub' => $Kd_Sub, 'Kd_Prog' => $Kd_Prog, 'Kd_Keg' => $Kd_Keg, 'Kd_Rek_1' => $Kd_Rek_1, 'Kd_Rek_2' => $Kd_Rek_2, 'Kd_Rek_3' => $Kd_Rek_3, 'Kd_Rek_4' => $Kd_Rek_4, 'Kd_Rek_5' => $Kd_Rek_5])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // public function actionTambah($id, $idkeg)
    // {

    //  $cookies = Yii::$app->request->cookies;
    //     if(!empty($cookies['skpd'])){
    //         $urusan=$cookies['urusan']->value;
    //         $bidang=$cookies['bidang']->value;
    //         $unit=$cookies['skpd']->value;
    //         $sub=$cookies['subUnit']->value;
    //     }else{
    //         $urusan = Yii::$app->user->identity->id_urusan;
    //         $bidang = Yii::$app->user->identity->id_bidang;
    //         $unit   = Yii::$app->user->identity->id_skpd;
    //         $sub    = Yii::$app->user->identity->id_subunit;
    //     }

    //     if($sub==0){
    //         $sub=$unit;
    //     }else{
    //         $sub=$sub;
    //     }
    //  $tahun=date('Y');
    //  $model = RefRek1::find()
    //      ->where(['Nm_Rek_1'=>'Belanja'])
    //      ->all();

    //     $modelProgram = RefProgram::find()
    //         ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
    //         ->one();
    //     $ketProgram = $modelProgram['Ket_Program'];
    //     $KdProg = $modelProgram['Kd_Prog'];

    //     $modelKegiatan = RefKegiatan::find()
    //         ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
    //         ->one();
    //     $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

    //  return $this->render('akun', [
    //      'model' => $model,
    //      'id' => $id,
    //      'idkeg' => $idkeg,
    //         'ketProgram' => $ketProgram,
    //         'ketKegiatan' => $ketKegiatan,
    //         'KdProg' => $KdProg,
    //  ]);
    // }

    public function actionUpdatebelanja($id, $idkeg, $rek1, $rek2, $rek3, $rek4,$rek5)
    {
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
            $urusan=$cookies['urusan']->value;
            $bidang=$cookies['bidang']->value;
            $unit=$cookies['skpd']->value;
            $sub=$cookies['subUnit']->value;
        }else{
            $urusan = Yii::$app->user->identity->id_urusan;
            $bidang = Yii::$app->user->identity->id_bidang;
            $unit   = Yii::$app->user->identity->id_skpd;
            $sub    = Yii::$app->user->identity->id_subunit;
        }

        if($sub==0){
            $sub=$unit;
        }else{
            $sub=$sub;
        }

        $tahun=date('Y');
        $mod = TaBelanja::find()->where([
            'Tahun'=>$tahun,
            'Kd_Urusan'=>$urusan,
            'Kd_Bidang'=>$bidang,
            'Kd_Unit'=>$unit,
            'Kd_Sub'=>$sub,
            'Kd_Prog'=>$id,
            'Kd_Keg'=>$idkeg,
            'Kd_Rek_1'=>$rek1,
             'Kd_Rek_2'=>$rek2,
              'Kd_Rek_3'=>$rek3,
               'Kd_Rek_4'=>$rek4,
            'Kd_Rek_5'=>$rek5])->one();

        $model = RefRek5::find()
            ->where(['Kd_Rek_1'=>$rek1, 'Kd_Rek_2'=>$rek2, 'Kd_Rek_3'=>$rek3, 'Kd_Rek_4'=>$rek4])
            ->all();

        $modelRek1 = RefRek1::find()->all();
        $modelRek2 = RefRek2::find()->where(['Kd_Rek_1'=>$rek1])->all();
        $modelRek3 = RefRek3::find()->where(['Kd_Rek_1'=>$rek1,'Kd_Rek_2'=>$rek2])->all();
        $modelRek4 = RefRek4::find()->where(['Kd_Rek_1'=>$rek1,'Kd_Rek_2'=>$rek2,'Kd_Rek_3'=>$rek3])->all();

        if ($mod->load(Yii::$app->request->post())){
            try {
                $mod->Tahun=$tahun;
                $mod->Kd_Urusan=$urusan;
                $mod->Kd_Bidang=$bidang;
                $mod->Kd_Unit=$unit;
                $mod->Kd_Sub=$sub;
                $mod->Kd_Prog=$id;
                $mod->Kd_Keg=$idkeg;
                $mod->save();
                Yii::$app->session->addFlash('success', "Data Berhasil Diubah");
            }  catch (\yii\db\Exception $e) {
                Yii::$app->session->addFlash('error', "Data Tidak Berhasil Diubah");
            }
            return $this->redirect(['listbelanja', 'id'=>$id, 'idkeg'=>$idkeg]);
        }

        $rek4N = RefRek4::find()
            ->where(['Kd_Rek_1'=>$rek1, 'Kd_Rek_2'=>$rek2, 'Kd_Rek_3'=>$rek3, 'Kd_Rek_4'=>$rek4])
            ->one();

        $modelProgram = RefProgram::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id])
            ->one();
        $ketProgram = $modelProgram['Ket_Program'];
        $KdProg = $modelProgram['Kd_Prog'];

        $modelKegiatan = RefKegiatan::find()
            ->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id, 'Kd_Keg'=>$idkeg])
            ->one();
        $ketKegiatan = $modelKegiatan['Ket_Kegiatan'];

        return $this->render('rincian', [
            'mod' => $mod,
            'model' => $model,
            'id' => $id,
            'idkeg' => $idkeg,
            'rek1' => $rek1,
            'rek2' => $rek2,
            'rek3' => $rek3,
            'rek4' => $rek4,
            'rek4N' => $rek4N->Nm_Rek_4,
            'ketProgram' => $ketProgram,
            'ketKegiatan' => $ketKegiatan,
            'KdProg' => $KdProg,
            'modelRek1' => $modelRek1,
            'modelRek2' => $modelRek2,
            'modelRek3' => $modelRek3,
            'modelRek4' => $modelRek4
        ]);
    }
} ?>	