<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Honor_Standard".
 *
 * @property integer $Kd_Standard
 * @property string $Tahun
 * @property integer $Kd_Honor_Sub_Jabatan
 * @property integer $Nilai
 * @property integer $Kd_Satuan
 */
class TaHonorStandard extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Honor_Standard';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Honor_Sub_Jabatan', 'Nilai', 'Kd_Satuan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Honor_Sub_Jabatan', 'Nilai', 'Kd_Satuan'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Standard' => 'Kd  Standard',
            'Tahun' => 'Tahun',
            'Kd_Honor_Sub_Jabatan' => 'Kd  Honor  Sub  Jabatan',
            'Nilai' => 'Nilai',
            'Kd_Satuan' => 'Kd  Satuan',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaHonorStandardQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaHonorStandardQuery(get_called_class());
    }
}
