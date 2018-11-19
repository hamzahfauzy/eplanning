<?php

namespace referensi\models;

use Yii;

/**
 * This is the model class for table "Ta_Sub_Unit".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property string $Nm_Pimpinan
 * @property string $Nip_Pimpinan
 * @property string $Jbt_Pimpinan
 * @property string $Alamat
 * @property string $Ur_Visi
 *
 * @property TaMisi[] $taMisis
 * @property RefUnit $kdUrusan
 * @property TaTupok[] $taTupoks
 */
class TaSubUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Sub_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Nm_Pimpinan'], 'string', 'max' => 50],
            [['Nip_Pimpinan'], 'string', 'max' => 21],
            [['Jbt_Pimpinan'], 'string', 'max' => 75],
            [['Alamat', 'Ur_Visi'], 'string', 'max' => 255],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'exist', 'skipOnError' => true, 'targetClass' => RefUnit::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']],
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
            'Nm_Pimpinan' => 'Nm  Pimpinan',
            'Nip_Pimpinan' => 'Nip  Pimpinan',
            'Jbt_Pimpinan' => 'Jbt  Pimpinan',
            'Alamat' => 'Alamat',
            'Ur_Visi' => 'Ur  Visi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMisis()
    {
        return $this->hasMany(TaMisi::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTupoks()
    {
        return $this->hasMany(TaTupok::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @inheritdoc
     * @return \referensi\models\query\TaSubUnitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \referensi\models\query\TaSubUnitQuery(get_called_class());
    }
}
