<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefProvinsi;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefDapil;

/**
 * This is the model class for table "Ta_Dapil".
 *
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut
 * @property integer $Kd_Dapil
 */
class TaDapil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Dapil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Dapil'], 'required'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Dapil'], 'integer'],
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
            // 'Kd_Kel' => 'Kd  Kel',
            //'Kd_Urut' => 'Kd  Urut',
            'Kd_Dapil' => 'Kode  Dapil',
        ];
    }

    /**
     * @inheritdoc
     * @return \userlevel\models\query\TaDapilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaDapilQuery(get_called_class());
    }

    public function getRefDapil() {
        return $this->hasOne(RefDapil::className(), ['Kd_Dapil' => 'Kd_Dapil']);
    }

    public function getRefKabupaten()
    {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    public function getRefProvinsi()
    {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    public function getRefKecamatan()
    {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }
}
