<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Transportasi".
 *
 * @property integer $Kd_Transportasi
 * @property string $Nm_Transportasi
 *
 * @property RefTransportasiKelas[] $refTransportasiKelas
 */
class RefTransportasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Transportasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Transportasi'], 'required'],
            [['Kd_Transportasi'], 'integer'],
            [['Nm_Transportasi'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Transportasi' => 'Kd  Transportasi',
            'Nm_Transportasi' => 'Nm  Transportasi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTransportasiKelas()
    {
        return $this->hasMany(RefTransportasiKelas::className(), ['Kd_Transportasi' => 'Kd_Transportasi']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefTransportasiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefTransportasiQuery(get_called_class());
    }
}
