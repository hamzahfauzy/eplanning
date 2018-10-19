<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ssh3".
 *
 * @property integer $Kd_Ssh1
 * @property integer $Kd_Ssh2
 * @property integer $Kd_Ssh3
 * @property string $Nm_Ssh3
 *
 * @property RefSsh2 $kdSsh1
 * @property RefSsh4[] $refSsh4s
 */
class RefSsh3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ssh3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3'], 'required'],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3'], 'integer'],
            [['Nm_Ssh3'], 'string', 'max' => 25],
            [['Kd_Ssh1', 'Kd_Ssh2'], 'exist', 'skipOnError' => true, 'targetClass' => RefSsh2::className(), 'targetAttribute' => ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2']],
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
            'Nm_Ssh3' => 'Uraian SSH 3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSsh1()
    {
        return $this->hasOne(RefSsh2::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSsh4s()
    {
        return $this->hasMany(RefSsh4::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSsh3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSsh3Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Ssh1.".".$this->Kd_Ssh2.".".$this->Kd_Ssh3;
    }
}
