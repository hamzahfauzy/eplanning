<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefJalan;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefStandardSatuan;
use common\models\RefProvinsi;
use common\models\RefLingkungan;
use common\models\RefStatusUsulan;

/**
 * This is the model class for table "Ta_Kelurahan_Pagu_Indikatif".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut
 * @property double $Pagu_Indikatif
 *
 * @property RefKelurahan $kdProv
 */
class TaKelurahanPaguIndikatif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Kelurahan_Pagu_Indikatif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut', 'Pagu_Indikatif'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut'], 'integer'],
            [['Pagu_Indikatif'], 'number'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut'], 'exist', 'skipOnError' => true, 'targetClass' => RefKelurahan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kd  Kec',
            'Kd_Kel' => 'Kd  Kel',
            'Kd_Urut' => 'Kd  Urut',
            'Pagu_Indikatif' => 'Pagu  Indikatif',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaKelurahanPaguIndikatifQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaKelurahanPaguIndikatifQuery(get_called_class());
    }

          

    public function getKdKab() {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    public function getKdKec() {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }
}
