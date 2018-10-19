<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Harga_Satuan_Pokok_Kegiatan".
 *
 * @property string $Tahun
 * @property integer $Kd_Benua
 * @property integer $Kd_Benua_Sub
 * @property integer $Kd_Benua_Sub_Negara
 * @property integer $Kd_Prov
 * @property integer $Kd_Kab
 * @property integer $Kd_Klasifikasi
 * @property integer $Kd_Aset1
 * @property integer $Kd_Aset2
 * @property integer $Kd_Aset3
 * @property integer $Kd_Aset4
 * @property integer $Kd_Aset5
 * @property integer $Kd_1
 * @property integer $Kd_2
 * @property integer $Kd_3
 * @property integer $Kd_Satuan
 *
 * @property RefKlasifikasiUsulan $kdKlasifikasi
 * @property RefStandardSatuan $kdSatuan
 * @property RefStandardHarga3 $tahun
 * @property RefRekAset5 $kdAset1
 */
class TaHargaSatuanPokokKegiatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Harga_Satuan_Pokok_Kegiatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Benua', 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara', 'Kd_Prov', 'Kd_Kab', 'Kd_Klasifikasi', 'Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3', 'Kd_Aset4', 'Kd_Aset5', 'Kd_1', 'Kd_2', 'Kd_3', 'Kd_Satuan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Benua', 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara', 'Kd_Prov', 'Kd_Kab', 'Kd_Klasifikasi', 'Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3', 'Kd_Aset4', 'Kd_Aset5', 'Kd_1', 'Kd_2', 'Kd_3', 'Kd_Satuan'], 'integer'],
            [['Kd_Klasifikasi'], 'exist', 'skipOnError' => true, 'targetClass' => RefKlasifikasiUsulan::className(), 'targetAttribute' => ['Kd_Klasifikasi' => 'Kd_Klasifikasi']],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
            [['Tahun', 'Kd_1', 'Kd_2', 'Kd_3', 'Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardHarga3::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1', 'Kd_2' => 'Kd_2', 'Kd_3' => 'Kd_3', 'Kd_Satuan' => 'Kd_Satuan']],
            [['Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3', 'Kd_Aset4', 'Kd_Aset5'], 'exist', 'skipOnError' => true, 'targetClass' => RefRekAset5::className(), 'targetAttribute' => ['Kd_Aset1' => 'Kd_Aset1', 'Kd_Aset2' => 'Kd_Aset2', 'Kd_Aset3' => 'Kd_Aset3', 'Kd_Aset4' => 'Kd_Aset4', 'Kd_Aset5' => 'Kd_Aset5']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Benua' => 'Kd  Benua',
            'Kd_Benua_Sub' => 'Kd  Benua  Sub',
            'Kd_Benua_Sub_Negara' => 'Kd  Benua  Sub  Negara',
            'Kd_Prov' => 'Kd  Prov',
            'Kd_Kab' => 'Kd  Kab',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Kd_Aset1' => 'Kd  Aset1',
            'Kd_Aset2' => 'Kd  Aset2',
            'Kd_Aset3' => 'Kd  Aset3',
            'Kd_Aset4' => 'Kd  Aset4',
            'Kd_Aset5' => 'Kd  Aset5',
            'Kd_1' => 'Kd 1',
            'Kd_2' => 'Kd 2',
            'Kd_3' => 'Kd 3',
            'Kd_Satuan' => 'Kd  Satuan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdKlasifikasi()
    {
        return $this->hasOne(RefKlasifikasiUsulan::className(), ['Kd_Klasifikasi' => 'Kd_Klasifikasi']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSatuan()
    {
        return $this->hasOne(RefStandardSatuan::className(), ['Kd_Satuan' => 'Kd_Satuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(RefStandardHarga3::className(), ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1', 'Kd_2' => 'Kd_2', 'Kd_3' => 'Kd_3', 'Kd_Satuan' => 'Kd_Satuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAset1()
    {
        return $this->hasOne(RefRekAset5::className(), ['Kd_Aset1' => 'Kd_Aset1', 'Kd_Aset2' => 'Kd_Aset2', 'Kd_Aset3' => 'Kd_Aset3', 'Kd_Aset4' => 'Kd_Aset4', 'Kd_Aset5' => 'Kd_Aset5']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaHargaSatuanPokokKegiatanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaHargaSatuanPokokKegiatanQuery(get_called_class());
    }
}
