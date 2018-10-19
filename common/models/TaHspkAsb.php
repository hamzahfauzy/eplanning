<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Hspk_Asb".
 *
 * @property integer $Kd_Asb1
 * @property integer $Kd_Asb2
 * @property integer $Kd_Asb3
 * @property integer $Kd_Asb4
 * @property integer $Kd_Asb5
 * @property integer $Kd_Hspk_Ssh1
 * @property integer $Kd_Hspk_Ssh2
 * @property integer $Kd_Hspk_Ssh3
 * @property integer $Kd_Hspk_Ssh4
 * @property integer $Kd_Ssh5
 * @property integer $Kd_Ssh6
 * @property string $Asal
 * @property integer $Kategori_Pekerjaan
 * @property string $Koefisien
 * @property integer $Kd_Satuan
 * @property double $Harga_Satuan
 * @property double $Jumlah_Harga
 *
 * @property RefAsb $kdAsb1
 * @property RefKategoriPekerjaanAsb $kategoriPekerjaan
 * @property RefStandardSatuan $kdSatuan
 */
class TaHspkAsb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Hspk_Asb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4', 'Kd_Asb5', 'Kd_Hspk_Ssh1', 'Kd_Hspk_Ssh2', 'Kd_Hspk_Ssh3', 'Kd_Hspk_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6', 'Asal', 'Kategori_Pekerjaan', 'Koefisien', 'Kd_Satuan', 'Harga_Satuan', 'Jumlah_Harga'], 'required'],
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4', 'Kd_Asb5', 'Kd_Hspk_Ssh1', 'Kd_Hspk_Ssh2', 'Kd_Hspk_Ssh3', 'Kd_Hspk_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6', 'Kategori_Pekerjaan', 'Kd_Satuan'], 'integer'],
            [['Asal'], 'string'],
            [['Koefisien', 'Harga_Satuan', 'Jumlah_Harga'], 'number'],
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4', 'Kd_Asb5'], 'exist', 'skipOnError' => true, 'targetClass' => RefAsb::className(), 'targetAttribute' => ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4', 'Kd_Asb5' => 'Kd_Asb5']],
            [['Kategori_Pekerjaan'], 'exist', 'skipOnError' => true, 'targetClass' => RefKategoriPekerjaanAsb::className(), 'targetAttribute' => ['Kategori_Pekerjaan' => 'Kd_Pekerjaan']],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Asb1' => 'Kd  Asb1',
            'Kd_Asb2' => 'Kd  Asb2',
            'Kd_Asb3' => 'Kd  Asb3',
            'Kd_Asb4' => 'Kd  Asb4',
            'Kd_Asb5' => 'Kd  Asb5',
            'Kd_Hspk_Ssh1' => 'Kd  Hspk  Ssh1',
            'Kd_Hspk_Ssh2' => 'Kd  Hspk  Ssh2',
            'Kd_Hspk_Ssh3' => 'Kd  Hspk  Ssh3',
            'Kd_Hspk_Ssh4' => 'Kd  Hspk  Ssh4',
            'Kd_Ssh5' => 'Kd  Ssh5',
            'Kd_Ssh6' => 'Kd  Ssh6',
            'Asal' => 'Asal',
            'Kategori_Pekerjaan' => 'Kategori  Pekerjaan',
            'Koefisien' => 'Koefisien',
            'Kd_Satuan' => 'Kd  Satuan',
            'Harga_Satuan' => 'Harga  Satuan',
            'Jumlah_Harga' => 'Jumlah  Harga',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAsb1()
    {
        return $this->hasOne(RefAsb::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4', 'Kd_Asb5' => 'Kd_Asb5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategoriPekerjaan()
    {
        return $this->hasOne(RefKategoriPekerjaanAsb::className(), ['Kd_Pekerjaan' => 'Kategori_Pekerjaan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSatuan()
    {
        return $this->hasOne(RefStandardSatuan::className(), ['Kd_Satuan' => 'Kd_Satuan']);
    }

    public function getKdSsh2()
    {
        return $this->hasOne(RefSsh::className(), ['Kd_Ssh1' => 'Kd_Hspk_Ssh1', 'Kd_Ssh2' => 'Kd_Hspk_Ssh2', 'Kd_Ssh3' => 'Kd_Hspk_Ssh3', 'Kd_Ssh4' => 'Kd_Hspk_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6']);
    }

    public function getKdHspk2()
    {
        return $this->hasOne(RefHspk::className(), ['Kd_Hspk1' => 'Kd_Hspk_Ssh1', 'Kd_Hspk2' => 'Kd_Hspk_Ssh2', 'Kd_Hspk3' => 'Kd_Hspk_Ssh3', 'Kd_Hspk4' => 'Kd_Hspk_Ssh4']);
    }

    public function getKdAsb2()
    {
        return $this->hasOne(RefAsb::className(), ['Kd_Asb1' => 'Kd_Hspk_Ssh1', 'Kd_Asb2' => 'Kd_Hspk_Ssh2', 'Kd_Asb3' => 'Kd_Hspk_Ssh3', 'Kd_Asb4' => 'Kd_Hspk_Ssh4', 'Kd_Asb5' => 'Kd_Ssh5']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaHspkAsbQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaHspkAsbQuery(get_called_class());
    }
}
