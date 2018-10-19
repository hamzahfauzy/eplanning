<?php

namespace common\models;

use Yii;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\TaMusrenbangKelurahan;

/**
 * This is the model class for table "Ref_Kecamatan".
 *
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property string $Nm_Kec
 *
 * @property TaMusrenbangKecamatan[] $taMusrenbangKecamatans
 * @property TaMusrenbangKecamatanAcara[] $taMusrenbangKecamatanAcaras
 * @property TaMusrenbangKecamatanRiwayat[] $taMusrenbangKecamatanRiwayats
 */
class RefKecamatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kecamatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'required'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'integer'],
            [['Nm_Kec'], 'string', 'max' => 255],
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
            'Kd_Kec' => 'Kode  Kecamatan',
            'Nm_Kec' => 'Kecamatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKecamatans()
    {
        return $this->hasMany(TaMusrenbangKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKecamatanAcaras()
    {
        return $this->hasMany(TaMusrenbangKecamatanAcara::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKecamatanRiwayats()
    {
        return $this->hasMany(TaMusrenbangKecamatanRiwayat::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    public function getProvinsi()
    {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten()
    {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    public function getUsulans()
    {
        return $this->hasMany(TaForumLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }
}
