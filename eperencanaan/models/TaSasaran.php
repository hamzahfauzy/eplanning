<?php

namespace eperencanaan\models;

use Yii;

/**
 * This is the model class for table "Ta_Sasaran".
 *
 * @property string $Tahun
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $No_Misi
 * @property int $No_Tujuan
 * @property int $No_Sasaran
 * @property string $Ur_Sasaran
 *
 * @property TaMusrenbang[] $taMusrenbangs
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
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'Ur_Sasaran' => 'Ur  Sasaran',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangs()
    {
        return $this->hasMany(TaMusrenbang::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaTujuan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    /**
     * @inheritdoc
     * @return TaSasaranQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaSasaranQuery(get_called_class());
    }
}
