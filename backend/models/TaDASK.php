<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_DASK".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property string $No_DPA
 * @property string $Tgl_DPA
 * @property string $No_DPPA
 * @property string $Tgl_DPPA
 */
class TaDASK extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_DASK';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Tgl_DPA', 'Tgl_DPPA'], 'safe'],
            [['No_DPA', 'No_DPPA'], 'string', 'max' => 50],
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
            'No_DPA' => 'No  Dpa',
            'Tgl_DPA' => 'Tgl  Dpa',
            'No_DPPA' => 'No  Dppa',
            'Tgl_DPPA' => 'Tgl  Dppa',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaDASKQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaDASKQuery(get_called_class());
    }
}
