<?php
namespace userlevel\models;

use yii;
use yii\base\Model;
//use common\models\User;
use yii\helpers\ArrayHelper;
use common\models\RefProvinsi;
use common\models\RefLevel;
use common\models\AuthAssignment;
use common\models\RefJenisUser;
use common\models\Referensi;
use userlevel\models\TaUserLevel;
use userlevel\models\TaUserKelompok;
use common\models\RefKelurahan;
use common\models\RefKecamatan;

/**
 * Signup form
 */
class TU3Form extends Model
{
    public $prov;
    public $kab;
    public $kel;
	public $kec;
	public $ling;
	public $j_user;
	public $level;
	public $opt;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prov','j_user','level'], 'required'],
			[['opt','kab','kec', 'kel', 'ling'], 'default']
        ];
    }
	
	public function attributeLabels(){
		return [
            'prov' => 'Provinsi',
            'kab' => 'Kabupaten/Kota',
            'kec' => 'Kecamatan',
            'kel' => 'Kelurahan',
            'ling' => 'Lingkungan',
            'j_user' => 'Jenis User',
            'level' => 'Level',
			'opt' => 'Opsi'
        ];
	}

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

	
	public function getProvinsi(){
		return ArrayHelper::map(RefProvinsi::find()->all(),'Kd_Prov','Nm_Prov');
	}
	
	public function getKec(){
	//	$config		= Yii::$app->configcomponent;
		$FdKd_Prov	= Yii::$app->pengaturan->Kolom('Kd_Prov');
		$FDKd_Kab	= Yii::$app->pengaturan->Kolom('Kd_Kab');
		return ArrayHelper::map(RefKecamatan::find()->where(['Kd_Prov'=>$FdKd_Prov, 'Kd_Kab'=>$FDKd_Kab])
			->all(),'Kd_Kec','Nm_Kec');
	}
	
	public function signup($id){
		//$config		= Yii::$app->configcomponent;
		$FdKd_Prov	= Yii::$app->pengaturan->Kolom('Kd_Prov');
		$FDKd_Kab	= Yii::$app->pengaturan->Kolom('Kd_Kab');
		
		//$kelompok = new TaUserKelompok();
		if (($kelompok = TaUserKelompok::findOne(['Kd_User' => $id])) == null){
			$kelompok = new TaUserKelompok();
			$kelompok->Kd_User = $id;
		}
		if (($level = TaUserLevel::findOne(['Kd_User' => $id])) == null){
			$level = new TaUserLevel();
			$level->Kd_User = $id;
		}
		
		//$assign = AuthAssignment::find()->where(['item_name'=>$this->level, 'user_id'=>$id])->one();
		
		//$assign = new AuthAssignment();
		
		$ref = new Referensi();
		
		$kelompok->Kd_Prov = $FdKd_Prov;
		$kelompok->Kd_Kab = $FDKd_Kab;
		$kelompok->Kd_Kec = !empty($this->kec) ? $this->kec : 0;
		if(!empty($this->kel)){
			$kelompok->Kd_Urut_Kel=$this->kel;
			$modelKel=RefKelurahan::find()->where(['Kd_Prov'=>$FdKd_Prov, 'Kd_Kab'=>$FDKd_Kab,
				'Kd_Kec'=>$this->kec, 'Kd_Urut'=>$this->kel])->one();
			$kelompok->Kd_Kel=$modelKel->Kd_Kel;
		}else{
			$kelompok->Kd_Urut_Kel=0;
			$kelompok->Kd_Kel=0;
		}
		$kelompok->Kd_Lingkungan = !empty($this->ling) ? $this->ling : 0;
		
		$kelompok->Kd_Jenis_User = $this->j_user;
		$level->Kd_User = $id;
		$level->Kd_Level = $this->level;
		$nmLevel = $ref->getLevelName($level);
		
		//$assign = AuthAssignment::find()->where(['user_id'=>$id])->one();
		if (($assign = AuthAssignment::findOne(['user_id' => $id])) == null){
			$assign = new AuthAssignment();
			$assign->user_id=$id;
		}
		$assign->item_name=$nmLevel;
		$assign->created_at=time();
		
		
		//print_r($this);
		return ($kelompok->save(false) && $level->save(false) && $assign->save(false));
	}

	/*public function signupedit($id){
		$config		= Yii::$app->configcomponent;
		$FdKd_Prov	= $config->FdKd_Prov;
		$FDKd_Kab	= $config->FDKd_Kab;
		
		//$kelompok = new TaUserKelompok();
		if(!isset(TaUserKelompok::find()->where(['Kd_User'=>$id])->one())){
			$kelompok = new TaUserKelompok();
		}else{
			$kelompok = TaUserKelompok::find()->where(['Kd_User'=>$id])->one();
		}
		
		if(!isset(TaUserLevel::find()->where(['Kd_User'=>$id])->one())){
			$level = new TaUserLevel();
		}else{
			$level = TaUserLevel::find()->where(['Kd_User'=>$id])->one();
		}
		
		//$assign = AuthAssignment::find()->where(['item_name'=>$this->level, 'user_id'=>$id])->one();
		
		//$assign = new AuthAssignment();
		
		$ref = new Referensi();
		$kelompok->Kd_User = $id;
		$kelompok->Kd_Prov = $FdKd_Prov;
		$kelompok->Kd_Kab = $FDKd_Kab;
		$kelompok->Kd_Kec = !empty($this->kec) ? $this->kec : 0;
		if(!empty($this->kel)){
			$kelompok->Kd_Urut_Kel=$this->kel;
			$modelKel=RefKelurahan::find()->where(['Kd_Prov'=>$FdKd_Prov, 'Kd_Kab'=>$FDKd_Kab,
				'Kd_Kec'=>$this->kec, 'Kd_Urut'=>$this->kel])->one();
			$kelompok->Kd_Kel=$modelKel->Kd_Kel;
		}else{
			$kelompok->Kd_Urut_Kel=0;
			$kelompok->Kd_Kel=0;
		}
		$kelompok->Kd_Lingkungan = !empty($this->ling) ? $this->ling : 0;
		
		$kelompok->Kd_Jenis_User = $this->j_user;
		$level->Kd_User = $id;
		$level->Kd_Level = $this->level;
		$nmLevel = $ref->getLevelName($level);
		
		//$assign = AuthAssignment::find()->where(['user_id'=>$id])->one();
		if(!isset(AuthAssignment::find()->where(['item_name'=>$nmLevel, 'user_id'=>$id])->one())){
			$assign = new AuthAssignment();
		}else{
			$assign = AuthAssignment::find()->where(['item_name'=>$nmLevel, 'user_id'=>$id])->one();
		}
		$assign->item_name=$nmLevel;
		$assign->user_id=$id;
		$assign->created_at=time();
		
		//print_r($this);
		return ($kelompok->save(false) && $level->save(false) && $assign->save(false));
	}*/
	
	public function getJenis(){
		return ArrayHelper::map(RefJenisUser::find()->all(),'Kd_Jenis_User','Nm_Jenis_User');
	}
	
	public function getLevel(){
		return ArrayHelper::map(RefLevel::find()->all(),'Kd_Level','Nm_Level');
	}
}
