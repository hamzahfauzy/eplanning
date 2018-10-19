<?php

namespace userlevel\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\RefUnit;
use common\models\RefSubUnit;
/**
 * This is the model class for table "Ta_User_Unit".
 *
 * @property integer $Kd_User
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 * @property integer $Kd_Sub_Unit
 */
class TaUserUnit extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_User_Unit';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan','Kd_Bidang','Kd_Unit','Kd_Sub_Unit'], 'required'],
            [['Kd_Urusan','Kd_Bidang','Kd_Unit','Kd_Sub_Unit'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_User' => 'No User',
            'Kd_Urusan' => 'Urusan',
            'Kd_Bidang' => 'Bidang',
            'Kd_Unit' => 'Unit',
            'Kd_Sub_Unit' => 'UPT',
        ];
    }

    public static function findUser($KdUser)
    {
        return static::findOne(['Kd_User' => $KdUser]);
    }
    public function getKdUnit() {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    public function getSubUnit(){
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub_Unit' => 'Kd_Sub_Unit']);
    }
}