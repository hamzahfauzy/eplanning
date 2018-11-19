<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Tujuan".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property string $Ur_Tujuan
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
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan'], 'integer'],
            [['Ur_Tujuan'], 'string', 'max' => 255],
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
            'Ur_Tujuan' => 'Ur  Tujuan',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaTujuanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaTujuanQuery(get_called_class());
    }
}
