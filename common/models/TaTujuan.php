<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Tujuan".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property string $Ur_Tujuan
 *
 * @property TaSasaran[] $taSasarans
 * @property TaMisi $tahun
 */
class TaTujuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Tujuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'Ur_Tujuan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan'], 'integer'],
            [['Ur_Tujuan'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi'], 'exist', 'skipOnError' => true, 'targetClass' => TaMisi::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Urusan',
            'Kd_Bidang' => 'Bidang',
            'Kd_Unit' => 'Unit',
            'Kd_Sub' => 'Sub Unit',
            'No_Misi' => 'Misi',
            'No_Tujuan' => 'No  Tujuan',
            'Ur_Tujuan' => 'Tujuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaSasarans()
    {
        return $this->hasMany(TaSasaran::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaMisi::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi']);
    }

    public function getMisi()
    {
        return $this->hasOne(TaMisi::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaTujuanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaTujuanQuery(get_called_class());
    }
}
