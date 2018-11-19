<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ssh".
 *
 * @property integer $Kd_Ssh1
 * @property integer $Kd_Ssh2
 * @property integer $Kd_Ssh3
 * @property integer $Kd_Ssh4
 * @property integer $Kd_Ssh5
 * @property integer $Kd_Ssh6
 * @property string $Nama_Barang
 * @property integer $Kd_Satuan
 * @property double $Harga_Satuan
 *
 * @property RefStandardSatuan $kdSatuan
 * @property RefSsh5 $kdSsh1
 * @property TaHspkAsb[] $taHspkAsbs
 * @property RefAsb[] $kdAsb1s
 * @property TaSshHspk[] $taSshHspks
 * @property RefHspk[] $kdHspk1s
 */
class RefSsh extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ssh';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6', 'Kd_Satuan'], 'required'],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6', 'Kd_Satuan'], 'integer'],
            [['Harga_Satuan'], 'number'],
            [['Nama_Barang'], 'string', 'max' => 255],
            // [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
            // [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5'], 'exist', 'skipOnError' => true, 'targetClass' => RefSsh5::className(), 'targetAttribute' => ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Ssh1' => 'Kode SSH 1',
            'Kd_Ssh2' => 'Kode SSH 2',
            'Kd_Ssh3' => 'Kode SSH 3',
            'Kd_Ssh4' => 'Kode SSH 4',
            'Kd_Ssh5' => 'Kode SSH 5',
            'Kd_Ssh6' => 'Kode SSH 6',
            'Nama_Barang' => 'Nama  Barang',
            'Kd_Satuan' => 'Satuan',
            'Harga_Satuan' => 'Harga  Satuan',
        ];
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
    public function getKdSsh1()
    {
        return $this->hasOne(RefSsh5::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaHspkAsbs()
    {
        return $this->hasMany(TaHspkAsb::className(), ['Kd_Hspk_Ssh1' => 'Kd_Ssh1', 'Kd_Hspk_Ssh2' => 'Kd_Ssh2', 'Kd_Hspk_Ssh3' => 'Kd_Ssh3', 'Kd_Hspk_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAsb1s()
    {
        return $this->hasMany(RefAsb::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4', 'Kd_Asb5' => 'Kd_Asb5'])->viaTable('Ta_Hspk_Asb', ['Kd_Hspk_Ssh1' => 'Kd_Ssh1', 'Kd_Hspk_Ssh2' => 'Kd_Ssh2', 'Kd_Hspk_Ssh3' => 'Kd_Ssh3', 'Kd_Hspk_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaSshHspks()
    {
        return $this->hasMany(TaSshHspk::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHspk1s()
    {
        return $this->hasMany(RefHspk::className(), ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3', 'Kd_Hspk4' => 'Kd_Hspk4'])->viaTable('Ta_Ssh_Hspk', ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSshQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSshQuery(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Ssh1.".".$this->Kd_Ssh2.".".$this->Kd_Ssh3.".".$this->Kd_Ssh4.".".$this->Kd_Ssh5.".".$this->Kd_Ssh6;
    }
}
