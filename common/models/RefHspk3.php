<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Hspk3".
 *
 * @property integer $Kd_Hspk1
 * @property integer $Kd_Hspk2
 * @property integer $Kd_Hspk3
 * @property string $Nm_Hspk3
 *
 * @property RefHspk[] $refHspks
 * @property RefHspk2 $kdHspk1
 */
class RefHspk3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Hspk3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3'], 'required'],
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3'], 'integer'],
            [['Nm_Hspk3'], 'string', 'max' => 255],
            [['Kd_Hspk1', 'Kd_Hspk2'], 'exist', 'skipOnError' => true, 'targetClass' => RefHspk2::className(), 'targetAttribute' => ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2']],
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
            'Nm_Hspk3' => 'Uraian HSPK 3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHspks()
    {
        return $this->hasMany(RefHspk::className(), ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2', 'Kd_Hspk3' => 'Kd_Hspk3']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdHspk1()
    {
        return $this->hasOne(RefHspk2::className(), ['Kd_Hspk1' => 'Kd_Hspk1', 'Kd_Hspk2' => 'Kd_Hspk2']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefHspk3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefHspk3Query(get_called_class());
    }

    public function getKode()
    {
        return $this->Kd_Hspk1.".".$this->Kd_Hspk2.".".$this->Kd_Hspk3;
    }
}
