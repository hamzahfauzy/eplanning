<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Kabupaten".
 *
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property string $Nm_Kab
 *
 * @property RefProvinsi $kdProv
 * @property RefKecamatan[] $refKecamatans
 */
class RefKabupaten extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kabupaten';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab'], 'required'],
            [['Kd_Prov', 'Kd_Kab'], 'integer'],
            [['Nm_Kab'], 'string', 'max' => 255],
            [['Kd_Prov'], 'exist', 'skipOnError' => true, 'targetClass' => RefProvinsi::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Prov' => 'Kode  Provinsi',
            'Kd_Kab' => 'Kode  Kabupaten',
            'Nm_Kab' => 'Kabupaten',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKecamatans()
    {
        return $this->hasMany(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKabupatenQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKabupatenQuery(get_called_class());
    }
    
     public function getRefLingkungans()
    {
        return $this->hasMany(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }
}
