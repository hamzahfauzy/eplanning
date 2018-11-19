<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Editdata".
 *
 * @property integer $Kd_Edit
 * @property string $Nm_Edit
 */
class RefEditdata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Editdata';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Edit'], 'required'],
            [['Kd_Edit'], 'integer'],
            [['Nm_Edit'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Edit' => 'Kd  Edit',
            'Nm_Edit' => 'Nm  Edit',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefEditdataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefEditdataQuery(get_called_class());
    }
}
