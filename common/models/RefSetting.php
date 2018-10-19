<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Setting".
 *
 * @property integer $Tahun
 * @property string $SistemKuitansi
 * @property string $StandardHarga
 * @property string $Kontrol_Angg_SPD
 * @property string $Kontrol_SPD_SPP
 * @property string $Kontrol_SPP_SPM
 * @property boolean $Locked
 * @property string $LastDBAplVer
 * @property boolean $DefaultPaper
 * @property boolean $SPDKegiatan
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Pembayaran
 * @property string $PFK
 * @property boolean $Peny_SPJ
 * @property boolean $SP2DPre
 * @property string $SP2DFormat
 * @property boolean $KunciPagu
 * @property string $Prognosis
 * @property boolean $Akrual
 */
class RefSetting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'PFK', 'Prognosis'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Pembayaran'], 'integer'],
            [['Locked', 'DefaultPaper', 'SPDKegiatan', 'Peny_SPJ', 'SP2DPre', 'KunciPagu', 'Akrual'], 'boolean'],
            [['SistemKuitansi', 'StandardHarga'], 'string', 'max' => 5],
            [['Kontrol_Angg_SPD', 'Kontrol_SPD_SPP', 'Kontrol_SPP_SPM', 'PFK', 'Prognosis'], 'string', 'max' => 1],
            [['LastDBAplVer'], 'string', 'max' => 25],
            [['SP2DFormat'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'SistemKuitansi' => 'Sistem Kuitansi',
            'StandardHarga' => 'Standard Harga',
            'Kontrol_Angg_SPD' => 'Kontrol  Angg  Spd',
            'Kontrol_SPD_SPP' => 'Kontrol  Spd  Spp',
            'Kontrol_SPP_SPM' => 'Kontrol  Spp  Spm',
            'Locked' => 'Locked',
            'LastDBAplVer' => 'Last Dbapl Ver',
            'DefaultPaper' => 'Default Paper',
            'SPDKegiatan' => 'Spdkegiatan',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Pembayaran' => 'Kd  Pembayaran',
            'PFK' => 'Pfk',
            'Peny_SPJ' => 'Peny  Spj',
            'SP2DPre' => 'Sp2 Dpre',
            'SP2DFormat' => 'Sp2 Dformat',
            'KunciPagu' => 'Kunci Pagu',
            'Prognosis' => 'Prognosis',
            'Akrual' => 'Akrual',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSettingQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSettingQuery(get_called_class());
    }
}
