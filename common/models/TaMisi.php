<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Misi".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property string $Ur_Misi
 *
 * @property TaSubUnit $tahun
 * @property TaTujuan[] $taTujuans
 */
class TaMisi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Misi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'Ur_Misi'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi'], 'integer'],
            [['Ur_Misi'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'exist', 'skipOnError' => true, 'targetClass' => TaSubUnit::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']],
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
            'Ur_Misi' => 'Misi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaSubUnit::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaTujuans()
    {
        return $this->hasMany(TaTujuan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'No_Misi' => 'No_Misi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaMisiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaMisiQuery(get_called_class());
    }
}
