<?php

namespace emusrenbang\models;

use Yii;
use common\models\RefSumberDana;
use common\models\RefApPub;
use common\models\RefRek5;
use common\models\TaPaguSubUnitApbn;

/**
 * This is the model class for table "Ta_Belanja_Rinc_Prov".
 *
 * @property string $Tahun
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $Kd_Prog
 * @property int $ID_Prog
 * @property int $Kd_Keg
 * @property int $Kd_Rek_1
 * @property int $Kd_Rek_2
 * @property int $Kd_Rek_3
 * @property int $Kd_Rek_4
 * @property int $Kd_Rek_5
 * @property int $No_Rinc
 * @property string $Keterangan
 * @property int $Kd_Sumber
 *
 * @property TaBelanjaProv $tahun
 * @property TaBelanjaRincSubProv[] $taBelanjaRincSubProvs
 */
class TaBelanjaRincApbn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Belanja_Rinc_Apbn';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'Keterangan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'Kd_Sumber'], 'integer'],
            [['Keterangan'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5'], 'exist', 'skipOnError' => true, 'targetClass' => TaBelanjaApbn::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'No_Rinc' => 'No  Rinc',
            'Keterangan' => 'Keterangan',
            'Kd_Sumber' => 'Kd  Sumber',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBelanja()
    {
        return $this->hasOne(TaBelanjaApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjaRincSubs()
    {
        return $this->hasMany(TaBelanjaRincSubApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaBelanjaRincProvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaBelanjaRincApbnQuery(get_called_class());
    }

    public function getUrusan()
    {
        return $this->hasOne(\common\models\RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getBidang()
    {
        return $this->hasOne(\common\models\RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getUnit()
    {
        return $this->hasOne(\common\models\RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    public function getSub()
    {
        return $this->hasOne(\common\models\RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getProgram() 
    {
        return $this->hasOne(\common\models\RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    } 

    public function getKegiatan()
    {
        return $this->hasOne(\emusrenbang\models\TaKegiatanApbn::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getKdRek5()
    {
        return $this->hasOne(\common\models\RefRek5::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }
}
