<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Pagu_Kegiatan".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Prog
 * @property double $pagu
 */
class TaPaguKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pagu_Kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog'], 'integer'],
            [['pagu'], 'number'],
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
            'Kd_Prog' => 'Kd  Prog',
            'pagu' => 'Pagu',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaPaguKegiatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaPaguKegiatanQuery(get_called_class());
    }
}
