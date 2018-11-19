<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Prioritas_BL".
 *
 * @property integer $Tahun
 * @property integer $Kd_Prioritas
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Prog
 * @property integer $Kd_Keg
 */
class TaPrioritasBL extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Prioritas_BL';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prioritas', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg'], 'required'],
            [['Tahun', 'Kd_Prioritas', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Prioritas' => 'Kd  Prioritas',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaPrioritasBLQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaPrioritasBLQuery(get_called_class());
    }
}
