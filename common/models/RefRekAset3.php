<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Rek_Aset3".
 *
 * @property integer $Kd_Aset1
 * @property integer $Kd_Aset2
 * @property integer $Kd_Aset3
 * @property string $Nm_Aset3
 *
 * @property RefRekAset2 $kdAset1
 * @property RefRekAset4[] $refRekAset4s
 */
class RefRekAset3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Rek_Aset3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3', 'Nm_Aset3'], 'required'],
            [['Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3'], 'integer'],
            [['Nm_Aset3'], 'string', 'max' => 255],
            [['Kd_Aset1', 'Kd_Aset2'], 'exist', 'skipOnError' => true, 'targetClass' => RefRekAset2::className(), 'targetAttribute' => ['Kd_Aset1' => 'Kd_Aset1', 'Kd_Aset2' => 'Kd_Aset2']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Aset1' => 'Kd  Aset1',
            'Kd_Aset2' => 'Kd  Aset2',
            'Kd_Aset3' => 'Kd  Aset3',
            'Nm_Aset3' => 'Nm  Aset3',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdAset1()
    {
        return $this->hasOne(RefRekAset2::className(), ['Kd_Aset1' => 'Kd_Aset1', 'Kd_Aset2' => 'Kd_Aset2']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRekAset4s()
    {
        return $this->hasMany(RefRekAset4::className(), ['Kd_Aset1' => 'Kd_Aset1', 'Kd_Aset2' => 'Kd_Aset2', 'Kd_Aset3' => 'Kd_Aset3']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefRekAset3Query the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefRekAset3Query(get_called_class());
    }
}
