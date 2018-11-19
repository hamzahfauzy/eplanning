<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Transportasi_Kelas".
 *
 * @property integer $Kd_Transportasi
 * @property integer $Kd_Kelas
 * @property string $Nm_Kelas
 *
 * @property RefTransportasi $kdTransportasi
 */
class RefTransportasiKelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Transportasi_Kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Transportasi', 'Kd_Kelas'], 'required'],
            [['Kd_Transportasi', 'Kd_Kelas'], 'integer'],
            [['Nm_Kelas'], 'string', 'max' => 50],
            [['Kd_Transportasi'], 'exist', 'skipOnError' => true, 'targetClass' => RefTransportasi::className(), 'targetAttribute' => ['Kd_Transportasi' => 'Kd_Transportasi']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Transportasi' => 'Kd  Transportasi',
            'Kd_Kelas' => 'Kd  Kelas',
            'Nm_Kelas' => 'Nm  Kelas',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdTransportasi()
    {
        return $this->hasOne(RefTransportasi::className(), ['Kd_Transportasi' => 'Kd_Transportasi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefTransportasiKelasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefTransportasiKelasQuery(get_called_class());
    }
}
