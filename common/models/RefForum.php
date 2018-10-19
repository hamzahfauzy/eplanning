<?php

namespace common\models;

use Yii;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\TaMusrenbangKelurahan;
use eperencanaan\models\TaMusrenbang;
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
class RefForum extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Sub_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Nm_Sub_Unit'], 'string', 'max' => 255],

            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub',], 'exist', 'skipOnError' => true, 'targetClass' => RefSubUnit::className(), 'targetAttribute' => ['Kd_Urusan'=>'Kd_Urusan', 'Kd_Bidang'=>'Kd_Bidang', 'Kd_Unit'=>'Kd_Unit', 'Kd_Sub'=>'Kd_Sub']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kode  Urusan',
            'Kd_Bidang' => 'Kode  Bidang',
            'Kd_Unit' => 'Kode  Unit',
            'Kd_Sub' => 'Kode  Sub Unit',
            'Nm_Sub_Unit' => 'Nama Sub Unit',
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
    public function getsub()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }
}
