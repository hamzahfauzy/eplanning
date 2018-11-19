<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Ssh5".
 *
 * @property integer $Kd_Ssh1
 * @property integer $Kd_Ssh2
 * @property integer $Kd_Ssh3
 * @property integer $Kd_Ssh4
 * @property integer $Kd_Ssh5
 * @property string $Nm_Ssh5
 *
 * @property RefSsh[] $refSshes
 * @property RefSsh4 $kdSsh1
 */
class RefSsh5 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Ssh5';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5'], 'required'],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5'], 'integer'],
            [['Nm_Ssh5'], 'string', 'max' => 255],
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4'], 'exist', 'skipOnError' => true, 'targetClass' => RefSsh4::className(), 'targetAttribute' => ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4']],
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
            'Nm_Ssh5' => 'Uraian SSH 5',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSshes()
    {
        return $this->hasMany(RefSsh::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4', 'Kd_Ssh5' => 'Kd_Ssh5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSsh1()
    {
        return $this->hasOne(RefSsh4::className(), ['Kd_Ssh1' => 'Kd_Ssh1', 'Kd_Ssh2' => 'Kd_Ssh2', 'Kd_Ssh3' => 'Kd_Ssh3', 'Kd_Ssh4' => 'Kd_Ssh4']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefSsh5Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefSsh5Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Ssh1.".".$this->Kd_Ssh2.".".$this->Kd_Ssh3.".".$this->Kd_Ssh4.".".$this->Kd_Ssh5;
    }
}
