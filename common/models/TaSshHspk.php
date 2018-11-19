<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Ssh_Hspk".
 *
 * @property integer $Kd_Hspk1
 * @property integer $Kd_Hspk2
 * @property integer $Kd_Hspk3
 * @property integer $Kd_Hspk4
 * @property integer $Kd_Ssh1
 * @property integer $Kd_Ssh2
 * @property integer $Kd_Ssh3
 * @property integer $Kd_Ssh4
 * @property integer $Kd_Ssh5
 * @property integer $Kd_Ssh6
 * @property string $Kategori
 * @property string $Koefisien
 * @property integer $Kd_Satuan
 * @property double $Harga_Satuan
 * @property double $Harga
 *
 * @property RefStandardSatuan $kdSatuan
 * @property RefHspk $kdHspk1
 * @property RefSsh $kdSsh1
 */
class TaSshHspk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Ssh_Hspk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3', 'Kd_Hspk4', 'Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6', 'Kategori', 'Koefisien', 'Kd_Satuan', 'Harga_Satuan', 'Harga'], 'required'],
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3', 'Kd_Hspk4', 'Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6', 'Kd_Satuan'], 'integer'],
            [['Kategori'], 'string'],
            [['Koefisien', 'Harga_Satuan', 'Harga'], 'number'],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3', 'Kd_Hspk4'], 'exist', 'skipOnError' => true, 'targetClass' => RefHspk::className(), 'targetAttribute' => ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3', 'Kd_Hspk4' => 'Kd_Hspk4']],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6'], 'exist', 'skipOnError' => true, 'targetClass' => RefSsh::className(), 'targetAttribute' => ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Hspk1' => 'Kd  Hspk1',
            'Kd_Hspk2' => 'Kd  Hspk2',
            'Kd_Hspk3' => 'Kd  Hspk3',
            'Kd_Hspk4' => 'Kd  Hspk4',
            'Kd_Ssh1' => 'Kd  Ssh1',
            'Kd_Ssh2' => 'Kd  Ssh2',
            'Kd_Ssh3' => 'Kd  Ssh3',
            'Kd_Ssh4' => 'Kd  Ssh4',
            'Kd_Ssh5' => 'Kd  Ssh5',
            'Kd_Ssh6' => 'Kd  Ssh6',
            'Kategori' => 'Kategori',
            'Koefisien' => 'Koefisien',
            'Kd_Satuan' => 'Kd  Satuan',
            'Harga_Satuan' => 'Harga  Satuan',
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
    public function getKdHspk1()
    {
        return $this->hasOne(RefHspk::className(), ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3', 'Kd_Hspk4' => 'Kd_Hspk4']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSsh1()
    {
        return $this->hasOne(RefSsh::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaSshHspkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaSshHspkQuery(get_called_class());
    }
}
