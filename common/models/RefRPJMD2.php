<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_RPJMD".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Prioritas_Pembangunan_Kota
 * @property string $Nm_Prioritas_Pembangunan_Kota
 * @property string $Keterangan
 *
 * @property RefKabupaten $kdProv
 * @property TaKelurahanVerifikasiUsulanLingkungan[] $taKelurahanVerifikasiUsulanLingkungans
 * @property TaMusrenbangKelurahan[] $taMusrenbangKelurahans
 */
class RefRPJMD2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_RPJMD2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Kota', 'Nm_Prioritas_Pembangunan_Kota', 'Keterangan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Kota'], 'integer'],
            [['Keterangan'], 'string'],
            [['Nm_Prioritas_Pembangunan_Kota'], 'string', 'max' => 128],
            [['Kd_Prov', 'Kd_Kab'], 'exist', 'skipOnError' => true, 'targetClass' => RefKabupaten::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Prioritas_Pembangunan_Kota' => 'Kd  Prioritas  Pembangunan  Kota',
            'Nm_Prioritas_Pembangunan_Kota' => 'Nm  Prioritas  Pembangunan  Kota',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaKelurahanVerifikasiUsulanLingkungans()
    {
        return $this->hasMany(TaKelurahanVerifikasiUsulanLingkungan::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Daerah' => 'Kd_Prioritas_Pembangunan_Kota']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKelurahans()
    {
        return $this->hasMany(TaMusrenbangKelurahan::className(), ['Tahun' => 'Tahun', 'Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Daerah' => 'Kd_Prioritas_Pembangunan_Kota']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefRPJMDQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefRPJMDQuery(get_called_class());
    }
}
