<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Sasaran".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property string $Ur_Sasaran
 *
 * @property TaTujuan $tahun
 */
class TaSasaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Sasaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'Ur_Sasaran'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'integer'],
            [['Ur_Sasaran'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan'], 'exist', 'skipOnError' => true, 'targetClass' => TaTujuan::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kode Urusan',
            'Kd_Bidang' => 'Kode Bidang',
            'Kd_Unit' => 'Kode Unit',
            'Kd_Sub' => 'Kode Sub Unit',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Ur_Sasaran' => 'Sasaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaTujuan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    public function getTaMisi()
    {
        return $this->hasOne(TaMisi::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi']);
    }

    public function getTaTujuan()
    {
        return $this->hasOne(TaTujuan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaSasaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaSasaranQuery(get_called_class());
    }
}
