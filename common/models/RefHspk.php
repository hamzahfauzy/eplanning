<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Hspk".
 *
 * @property integer $Kd_Hspk1
 * @property integer $Kd_Hspk2
 * @property integer $Kd_Hspk3
 * @property integer $Kd_Hspk4
 * @property string $Uraian_Kegiatan
 * @property integer $Kd_Satuan
 * @property double $Harga
 *
 * @property RefHspk3 $kdHspk1
 * @property RefStandardSatuan $kdSatuan
 * @property TaSshHspk[] $taSshHspks
 * @property RefSsh[] $kdSsh1s
 */
class RefHspk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Hspk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3', 'Kd_Hspk4', 'Kd_Satuan'], 'required'],
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3', 'Kd_Hspk4', 'Kd_Satuan'], 'integer'],
            [['Harga'], 'number'],
            [['Uraian_Kegiatan'], 'string', 'max' => 255],
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3'], 'exist', 'skipOnError' => true, 'targetClass' => RefHspk3::className(), 'targetAttribute' => ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3']],
            [['Kd_Satuan'], 'exist', 'skipOnError' => true, 'targetClass' => RefStandardSatuan::className(), 'targetAttribute' => ['Kd_Satuan' => 'Kd_Satuan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Hspk1' => 'Kode HSPK 1',
            'Kd_Hspk2' => 'Kode HSPK 2',
            'Kd_Hspk3' => 'Kode HSPK 3',
            'Kd_Hspk4' => 'Kode HSPK 4',
            'Uraian_Kegiatan' => 'Uraian  Kegiatan',
            'Kd_Satuan' => 'Satuan',
            'Harga' => 'Harga',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHspk1()
    {
        return $this->hasOne(RefHspk3::className(), ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3']);
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
    public function getTaSshHspks()
    {
        return $this->hasMany(TaSshHspk::className(), ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3', 'Kd_Hspk4' => 'Kd_Hspk4']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSsh1s()
    {
        return $this->hasMany(RefSsh::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5', 'Kd_Ssh6' => 'Kd_Ssh6'])->viaTable('Ta_Ssh_Hspk', ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3', 'Kd_Hspk4' => 'Kd_Hspk4']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHspkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHspkQuery(get_called_class());
    }

    public function getKode()
    {
        return $this['Kd_Hspk1'].".".$this['Kd_Hspk2'].".".$this['Kd_Hspk3'].".".$this['Kd_Hspk4'];
    }
}
