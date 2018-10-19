<?php

namespace userlevel\models;

use Yii;
use common\models\RefProvinsi;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefLingkungan;

/**
 * This is the model class for table "ta_user_kelompok".
 *
 * @property integer $Kd_User
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kelurahan
 * @property integer $Kd_Jenis_User
 */
class TaUserKelompok extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_User_Kelompok';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_User', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jenis_User'], 'required'],
            [['Kd_User', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jenis_User'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_User' => 'Kd  User',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Kec' => 'Kd  Kec',
            'Kd_Kel' => 'Kd  Kelurahan',
            'Kd_Jenis_User' => 'Kd  Jenis  User',
			
        ];
    }


    public function getKdProv() {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    public function getKdKab() {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    public function getKdKec() {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    public function getKdKel() {
        return $this->hasOne(RefKelurahan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut_Kel']);
    }
	
	 public function getKdLink() {
        return $this->hasOne(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec',
                    'Kd_Kel' => 'Kd_Kel', 'Kd_Urut' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

}
