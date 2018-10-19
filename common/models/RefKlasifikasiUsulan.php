<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Klasifikasi_Usulan".
 *
 * @property integer $Kd_Klasifikasi
 * @property string $Nm_Klasifikasi
 */
class RefKlasifikasiUsulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Klasifikasi_Usulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Klasifikasi'], 'required'],
            [['Kd_Klasifikasi'], 'integer'],
            [['Nm_Klasifikasi'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Nm_Klasifikasi' => 'Nm  Klasifikasi',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKlasifikasiUsulanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKlasifikasiUsulanQuery(get_called_class());
    }
}
