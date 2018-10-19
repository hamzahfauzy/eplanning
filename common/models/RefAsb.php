<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Asb".
 *
 * @property integer $Kd_Asb1
 * @property integer $Kd_Asb2
 * @property integer $Kd_Asb3
 * @property integer $Kd_Asb4
 * @property integer $Kd_Asb5
 * @property string $Jenis_Pekerjaan
 * @property integer $Kd_Satuan
 * @property double $Harga
 *
 * @property RefStandardSatuan $kdSatuan
 * @property RefAsb4 $kdAsb1
 * @property TaHspkAsb[] $taHspkAsbs
 * @property RefSsh[] $kdHspkSsh1s
 */
class RefAsb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Asb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4', 'Kd_Asb5', 'Kd_Satuan'], 'required'],
             [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4', 'Kd_Asb5', 'Kd_Satuan', 'Jenis_Pekerjaan'], 'required'],
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4', 'Kd_Asb5', 'Kd_Satuan'], 'integer'],
            [['Harga'], 'number'],
            [['Jenis_Pekerjaan'], 'string', 'max' => 255],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4'], 'exist', 'skipOnError' => true, 'targetClass' => RefAsb4::className(), 'targetAttribute' => ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Asb1' => 'Kode ASB 1',
            'Kd_Asb2' => 'Kode ASB 2',
            'Kd_Asb3' => 'Kode ASB 3',
            'Kd_Asb4' => 'Kode ASB 4',
            'Kd_Asb5' => 'Kode ASB 5',
            'Jenis_Pekerjaan' => 'Jenis  Pekerjaan',
            'Kd_Satuan' => 'Satuan',
            'Harga' => 'Harga',
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
    public function getKdAsb1()
    {
        return $this->hasOne(RefAsb4::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaHspkAsbs()
    {
        return $this->hasMany(TaHspkAsb::className(), ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4', 'Kd_Asb5' => 'Kd_Asb5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHspkSsh1s()
    {
        return $this->hasMany(RefSsh::className(), ['Kd_Ssh1' => 'Kd_Hspk_Ssh1', 'Kd_Ssh2' => 'Kd_Hspk_Ssh2', 'Kd_Ssh3' => 'Kd_Hspk_Ssh3', 'Kd_Ssh4' => 'Kd_Hspk_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6'])->viaTable('Ta_Hspk_Asb', ['Kd_Asb1' => 'Kd_Asb1', 'Kd_Asb2' => 'Kd_Asb2', 'Kd_Asb3' => 'Kd_Asb3', 'Kd_Asb4' => 'Kd_Asb4', 'Kd_Asb5' => 'Kd_Asb5']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefAsbQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefAsbQuery(get_called_class());
    }
}
