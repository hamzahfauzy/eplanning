<?php

namespace common\models;

use Yii;
use eperencanaan\models\TaForumLingkungan;
use eperencanaan\models\TaMusrenbangKelurahan;
use eperencanaan\models\TaKelurahanVerifikasiUsulanLingkungan;
use eperencanaan\models\TaMusrenbangKelurahanAcara;

/**
 * This is the model class for table "Ref_Kelurahan".
 *
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut
 * @property string $Nm_Kel
 *
 * @property RefKecamatan $kdProv
 * @property TaKelurahanPaguIndikatif[] $taKelurahanPaguIndikatifs
 * @property TaMusrenbangKelurahan[] $taMusrenbangKelurahans
 * @property TaMusrenbangKelurahanAcara[] $taMusrenbangKelurahanAcaras
 */
class RefKelurahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kelurahan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut'], 'required'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut'], 'integer'],
            [['Nm_Kel'], 'string', 'max' => 255],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'exist', 'skipOnError' => true, 'targetClass' => RefKecamatan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kd  Kec',
            'Kd_Kel' => 'Kd  Kel',
            'Kd_Urut' => 'Kd  Urut',
            'Nm_Kel' => 'Nm  Kel',
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
    public function getKabupaten()
    {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKecamatan()
    {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    /**
   
    public function getKdKec()
    {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }
  * @return \yii\db\ActiveQuery
     */
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaKelurahanPaguIndikatifs()
    {
        return $this->hasMany(TaKelurahanPaguIndikatif::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKelurahans()
    {
        return $this->hasMany(TaMusrenbangKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    
    public function getTaMusrenbangKelurahanAcara()
    {
        return $this->hasOne(TaMusrenbangKelurahanAcara::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']);
    }
    
    public function getLingkungans()
    {
        return $this->hasMany(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']);
    }

    public function getUsulans()
    {
        return $this->hasMany(TaForumLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']);
    }
    /**
     * @inheritdoc
     * @return \common\models\query\RefKelurahanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKelurahanQuery(get_called_class());
    }

        /**
     * @return \yii\db\ActiveQuery
     */
      public function getTaMusrenbangKelurahanVerifikasis()
    {
        return $this->hasMany(TaKelurahanVerifikasiUsulanLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut']);
    }
}
