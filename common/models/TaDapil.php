<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Dapil".
 *
 * @property string $Tahun
 * @property integer $Kd_Dapil
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Kec
 *
 * @property RefDapil $tahun
 * @property RefKecamatan $kdProv
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
            [['Tahun', 'Kd_Dapil', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Dapil', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'integer'],
            [['Tahun', 'Kd_Dapil'], 'exist', 'skipOnError' => true, 'targetClass' => RefDapil::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'exist', 'skipOnError' => true, 'targetClass' => RefKecamatan::className(), 'targetAttribute' => ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Dapil' => 'Kode  Dapil',
            'Kd_Prov' => 'Kode  Provinsi',
            'Kd_Kab' => 'Kode  Kabupaten',
            'Kd_Kec' => 'Kode  Kecamatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(RefDapil::className(), ['Tahun' => 'Tahun', 'Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProvinsi()
    {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    public function getRefKabupaten()
    {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    public function getrefKecamatan()
    {
        return $this->hasOne(RefKecamatan::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab', 'Kd_Kec' => 'Kd_Kec']);
    }

    public function getRefDapil()
    {
        return $this->hasOne(RefDapil::className(), ['Kd_Dapil' => 'Kd_Dapil']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaDapilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaDapilQuery(get_called_class());
    }
}
