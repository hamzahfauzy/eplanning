<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ssh4".
 *
 * @property integer $Kd_Ssh1
 * @property integer $Kd_Ssh2
 * @property integer $Kd_Ssh3
 * @property integer $Kd_Ssh4
 * @property string $Nm_Ssh4
 *
 * @property RefSsh3 $kdSsh1
 * @property RefSsh5[] $refSsh5s
 */
class RefSsh4 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ssh4';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4'], 'required'],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4'], 'integer'],
            [['Nm_Ssh4'], 'string', 'max' => 255],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3'], 'exist', 'skipOnError' => true, 'targetClass' => RefSsh3::className(), 'targetAttribute' => ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3']],
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
            'Nm_Ssh4' => 'Uraian SSH 4',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSsh1()
    {
        return $this->hasOne(RefSsh3::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSsh5s()
    {
        return $this->hasMany(RefSsh5::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSsh4Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSsh4Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Ssh1.".".$this->Kd_Ssh2.".".$this->Kd_Ssh3.".".$this->Kd_Ssh4;
    }
}
