<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ssh2".
 *
 * @property integer $Kd_Ssh1
 * @property integer $Kd_Ssh2
 * @property string $Nm_Ssh2
 *
 * @property RefSsh1 $kdSsh1
 * @property RefSsh3[] $refSsh3s
 */
class RefSsh2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ssh2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['Kd_Ssh1', 'Kd_Ssh2'], 'unique', 'message'=>'{attribute}:{value} already exists!'],
            // ['Kd_Ssh2', 'unique', 'targetAttribute' => ['Kd_Ssh1', 'Kd_Ssh2']],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Nm_Ssh2'], 'required'],
            [['Kd_Ssh1', 'Kd_Ssh2'], 'integer'],
            [['Nm_Ssh2'], 'string', 'max' => 255],
            // [['Kd_Ssh1'], 'exist', 'skipOnError' => true, 'targetClass' => RefSsh1::className(), 'targetAttribute' => ['Kd_Ssh1' => 'Kd_Ssh1']],
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
            'Nm_Ssh2' => 'Uraian SSH 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSsh1()
    {
        return $this->hasOne(RefSsh1::className(), ['Kd_Ssh1' => 'Kd_Ssh1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSsh3s()
    {
        return $this->hasMany(RefSsh3::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSsh2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSsh2Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Ssh1.".".$this->Kd_Ssh2;
    }
}
