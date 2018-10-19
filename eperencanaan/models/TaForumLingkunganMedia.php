<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefMedia;
use common\models\RefJalan;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefStandardSatuan;
use common\models\RefProvinsi;
use common\models\RefLingkungan;
use common\models\RefStatusUsulan;

/**
 * This is the model class for table "Ta_Forum_Lingkungan_Media".
 *
 * @property string $Tahun
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 * @property integer $Kd_Kel
 * @property integer $Kd_Urut_Kel
 * @property integer $Kd_Lingkungan
 * @property integer $Kd_Media
 * @property string $Jenis_Dokumen
 *
 * @property RefLingkungan $kdProv
 * @property RefMedia $kdMedia
 */
class TaForumLingkunganMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Forum_Lingkungan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Media', 'Jenis_Dokumen'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Media'], 'integer'],
            [['Jenis_Dokumen'], 'string'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan'], 'exist', 'skipOnError' => true, 'targetClass' => RefLingkungan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']],
            [['Kd_Media'], 'exist', 'skipOnError' => true, 'targetClass' => RefMedia::className(), 'targetAttribute' => ['Kd_Media' => 'Kd_Media']],
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
            'Kd_Urut_Kel' => 'Kd  Urut  Kel',
            'Kd_Lingkungan' => 'Kd  Lingkungan',
            'Kd_Media' => 'Kd  Media',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdProv()
    {
        return $this->hasOne(RefLingkungan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec', 'Kd_Kel' => 'Kd_Kel', 'Kd_Urut_Kel' => 'Kd_Urut_Kel', 'Kd_Lingkungan' => 'Kd_Lingkungan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdMedia()
    {
        return $this->hasOne(RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaForumLingkunganMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaForumLingkunganMediaQuery(get_called_class());
    }
}
