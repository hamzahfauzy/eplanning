<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Hspk2".
 *
 * @property integer $Kd_Hspk1
 * @property integer $Kd_Hspk2
 * @property string $Nm_Hspk2
 *
 * @property RefHspk1 $kdHspk1
 * @property RefHspk3[] $refHspk3s
 */
class RefHspk2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Hspk2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Hspk1', 'Kd_Hspk2'], 'required'],
            [['Kd_Hspk1', 'Kd_Hspk2'], 'integer'],
            [['Nm_Hspk2'], 'string', 'max' => 255],
            [['Kd_Hspk1'], 'exist', 'skipOnError' => true, 'targetClass' => RefHspk1::className(), 'targetAttribute' => ['Kd_Hspk1' => 'Kd_Hspk1']],
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
            'Nm_Hspk2' => 'Uraian HSPK 2',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHspk1()
    {
        return $this->hasOne(RefHspk1::className(), ['Kd_Hspk1' => 'Kd_Hspk1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHspk3s()
    {
        return $this->hasMany(RefHspk3::className(), ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHspk2Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHspk2Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Hspk1.".".$this->Kd_Hspk2;
    }
}
