<?php
namespace userlevel\models;

use yii\base\Model;
//use common\models\User;
use yii\helpers\ArrayHelper;
use common\models\RefUnit;
use common\models\RefSubUnit;
use common\models\RefKabupaten;
use userlevel\models\TaUserLevel;
use userlevel\models\TaUserUnit;

/**
 * Signup form
 */
class TU4Form extends Model
{
    public $optk1;
    public $optk2;
    public $kota;
	public $chk;
	public $optk5;
	//public $optk1;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['optk1'], 'required'],
			[['optk2','kota','chk', 'optk5'], 'default']
        ];
    }
	
	public function attributeLabels(){
		return [
            'optk1' => 'Unit',
            'optk2' => 'Sub Unit',
            'kota' => 'Kab/Kota',
            'chk' => '',
            'optk5' => 'Unit/Sub Unit'
            
           
        ];
	}

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
	
	public function getKota()
	{
		$prov=12;
		$r=ArrayHelper::map(RefKabupaten::find()->where(['Kd_Prov'=>$prov])->all(),'Kd_Kab','Nm_Kab');
		
		return $r;
	}
	
	public function getUnit(){
		return ArrayHelper::map(RefUnit::find()->all(),'Nm_Unit','Nm_Unit');
	}
	public function getSubUnit(){
		return ArrayHelper::map(RefSubUnit::find()->all(),'Nm_Sub_Unit','Nm_Sub_Unit');
	}
	
	public function signup($id){
		$unit = new TaUserUnit();
		$unit->Kd_User = $id;
		$id = RefUnit::find()->where(['Nm_Unit'=> $this->optk1])->one()->Kd_Unit;
		$unit->Kd_Urusan = RefSubUnit::find()->where(['Kd_Unit'=> $id])->andWhere(['Nm_Sub_Unit'=> $this->optk2])->one()->Kd_Urusan;
		$unit->Kd_Bidang = RefSubUnit::find()->where(['Kd_Unit'=> $id])->andWhere(['Nm_Sub_Unit'=> $this->optk2])->one()->Kd_Bidang;
		$unit->Kd_Unit = RefSubUnit::find()->where(['Kd_Unit'=> $id])->andWhere(['Nm_Sub_Unit'=> $this->optk2])->one()->Kd_Unit;
		$unit->Kd_Sub_Unit = RefSubUnit::find()->where(['Kd_Unit'=> $id])->andWhere(['Nm_Sub_Unit'=> $this->optk2])->one()->Kd_Sub;
		return($unit->save(false));
		
		//$unit->Kd_Urusan = RefUnit::find()->where(['Nm_Unit'=> $this->opt1])->Kd_Sub_Unit()->one();
	}
	
	
	
}
