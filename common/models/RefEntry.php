<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Entry".
 *
 * @property integer $Tahun
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub
 * @property integer $Kd_Penandatangan
 * @property string $Nm_Penandatangan
 * @property string $Nip_Penandatangan
 * @property string $Jbt_Penandatangan
 * @property string $Jns_Dokumen
 */
class RefEntry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Entry';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Penandatangan'], 'required'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Penandatangan'], 'integer'],
            [['Nm_Penandatangan'], 'string', 'max' => 50],
            [['Nip_Penandatangan'], 'string', 'max' => 21],
            [['Jbt_Penandatangan'], 'string', 'max' => 75],
            [['Jns_Dokumen'], 'string', 'max' => 10],
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
            'Kd_Penandatangan' => 'Kd  Penandatangan',
            'Nm_Penandatangan' => 'Nm  Penandatangan',
            'Nip_Penandatangan' => 'Nip  Penandatangan',
            'Jbt_Penandatangan' => 'Jbt  Penandatangan',
            'Jns_Dokumen' => 'Jns  Dokumen',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefEntryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefEntryQuery(get_called_class());
    }
}
