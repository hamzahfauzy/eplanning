<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Tupok".
 *
 * @property string $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Tupok
 * @property string $Ur_Tupok
 *
 * @property TaSubUnit $tahun
 */
class TaTupok extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Tupok';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Tupok', 'Ur_Tupok'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Tupok'], 'integer'],
            [['Ur_Tupok'], 'string', 'max' => 255],
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
            'No_Tupok' => 'No  Tupok',
            'Ur_Tupok' => 'Tupok',
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
     * @inheritdoc
     * @return \common\models\query\TaTupokQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaTupokQuery(get_called_class());
    }
}
