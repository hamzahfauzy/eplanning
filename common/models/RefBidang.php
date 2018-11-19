<?php

namespace common\models;

use Yii;
use emusrenbang\models\TaBelanjaRincSub;
use common\models\TaKegiatan;

/**
 * This is the model class for table "Ref_Bidang".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property string $Nm_Bidang
 * @property integer $Kd_Fungsi
 *
 * @property RefUrusan $kdUrusan
 * @property RefProgram[] $refPrograms
 * @property RefUnit[] $refUnits
 */
class RefBidang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Bidang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Nm_Bidang', 'Kd_Fungsi'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Fungsi'], 'integer'],
            [['Nm_Bidang'], 'string', 'max' => 255],
            [['Kd_Urusan'], 'exist', 'skipOnError' => true, 'targetClass' => RefUrusan::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

            'Kd_Urusan' => 'Kode  Urusan',
            'Kd_Bidang' => 'Kode  Bidang',
            'Nm_Bidang' => 'Bidang',
            'Kd_Fungsi' => 'Kode Fungsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPrograms()
    {
        return $this->hasMany(RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUnits()
    {
        return $this->hasMany(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }
    
    public function getFungsi()
    {
        return $this->hasOne(RefFungsi::className(), ['Kd_Fungsi' => 'Kd_Fungsi']);
    }

    public function getUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getSumBelanjaRincSub()
    {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang'=>'Kd_Bidang'])->sum("Total");
    }

    public function getSumKegiatan()
    {
        return $this->hasMany(TaKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang'=>'Kd_Bidang'])->sum("Pagu_Anggaran_Nt1");
    }

    public function getCountKegiatan()
    {
        return $this->hasMany(TaKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang'=>'Kd_Bidang'])->count();
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefBidangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefBidangQuery(get_called_class());
    }
}
