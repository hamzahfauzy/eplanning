<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "Ta_Belanja_Riwayat".
 *
 * @property int $Id
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
 * @property int $Kd_Ap_Pub
 * @property int $Kd_Sumber
 * @property string $Tanggal_Riwayat
 * @property string $Keterangan_Riwayat
 *
 * @property TaBelanja $tahun
 */
class TaBelanjaRiwayat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Belanja_Riwayat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5'], 'required'],
            [['Tahun', 'Tanggal_Riwayat'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Ap_Pub', 'Kd_Sumber'], 'integer'],
            [['Keterangan_Riwayat'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5'], 'exist', 'skipOnError' => true, 'targetClass' => TaBelanja::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
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
            'Kd_Ap_Pub' => 'Kd  Ap  Pub',
            'Kd_Sumber' => 'Kd  Sumber',
            'Tanggal_Riwayat' => 'Tanggal  Riwayat',
            'Keterangan_Riwayat' => 'Keterangan  Riwayat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaBelanja::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaBelanjaRiwayatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaBelanjaRiwayatQuery(get_called_class());
    }
}
