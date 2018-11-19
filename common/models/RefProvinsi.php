<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Provinsi".
 *
 * @property integer $Kd_Prov
 * @property string $Nm_Prov
 *
 * @property RefKabupaten[] $refKabupatens
 */
class RefProvinsi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Provinsi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov'], 'required'],
            [['Kd_Prov'], 'integer'],
            [['Nm_Prov'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Prov' => 'Kode  Provinsi',
            'Nm_Prov' => 'Provinsi',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKabupatens()
    {
        return $this->hasMany(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefProvinsiQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefProvinsiQuery(get_called_class());
    }
}
