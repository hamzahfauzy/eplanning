<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Komisi_Dprd".
 *
 * @property string $Tahun
 * @property int $Kd_Komisi
 * @property string $Nm_Komisi
 * @property string $Keterangan
 *
 * @property TaUserDapil[] $taUserDapils
 */
class RefKomisiDprd extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Komisi_Dprd';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Komisi', 'Nm_Komisi', 'Keterangan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Komisi'], 'integer'],
            [['Nm_Komisi', 'Keterangan'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Komisi' => 'Kd  Komisi',
            'Nm_Komisi' => 'Nm  Komisi',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaUserDapils()
    {
        return $this->hasMany(TaUserDapil::className(), ['Tahun' => 'Tahun', 'Kd_Komisi' => 'Kd_Komisi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKomisiDprdQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKomisiDprdQuery(get_called_class());
    }
}
