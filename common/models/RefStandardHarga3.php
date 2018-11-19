<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Standard_Harga_3".
 *
 * @property string $Tahun
 * @property integer $Kd_1
 * @property integer $Kd_2
 * @property integer $Kd_3
 * @property string $Uraian
 * @property double $Harga
 * @property integer $Kd_Satuan
 * @property string $Keterangan
 *
 * @property RefStandardHarga2 $tahun
 * @property RefStandardSatuan $kdSatuan
 * @property TaHargaSatuanPokokKegiatan[] $taHargaSatuanPokokKegiatans
 */
class RefStandardHarga3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Standard_Harga_3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_1', 'Kd_2', 'Kd_3', 'Uraian', 'Harga', 'Kd_Satuan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_1', 'Kd_2', 'Kd_3', 'Kd_Satuan'], 'integer'],
            [['Harga'], 'number'],
            [['Uraian', 'Keterangan'], 'string', 'max' => 255],
            [['Tahun', 'Kd_1', 'Kd_2'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardHarga2::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1', 'Kd_2' => 'Kd_2']],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_1' => 'Kd 1',
            'Kd_2' => 'Kd 2',
            'Kd_3' => 'Kd 3',
            'Uraian' => 'Uraian',
            'Harga' => 'Harga',
            'Kd_Satuan' => 'Kd  Satuan',
            'Keterangan' => 'Keterangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(RefStandardHarga2::className(), ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1', 'Kd_2' => 'Kd_2']);
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
    public function getTaHargaSatuanPokokKegiatans()
    {
        return $this->hasMany(TaHargaSatuanPokokKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_1' => 'Kd_1', 'Kd_2' => 'Kd_2', 'Kd_3' => 'Kd_3', 'Kd_Satuan' => 'Kd_Satuan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefStandardHarga3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefStandardHarga3Query(get_called_class());
    }
}
