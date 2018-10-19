<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "level_unit".
 *
 * @property integer $id
 * @property string $username
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Unit
 */
class LevelUnit extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'level_unit';
    }

    public $Nm_Urusan;
    public $Nm_Bidang;
    public $Nm_Unit;
    public $Nm_Sub_Unit;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit'], 'integer'],
            [['username'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Nm_Urusan' => 'Urusan',
            'Nm_Bidang' => 'Sektor',
            'Nm_Unit' => 'Unit',
            'Nm_Sub_Unit' => 'Sub Unit',
        ];
    }
}
