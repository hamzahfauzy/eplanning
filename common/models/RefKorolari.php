<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Korolari".
 *
 * @property integer $Kd_Rek_1
 * @property integer $Kd_Rek_2
 * @property integer $Kd_Rek_3
 * @property integer $Kd_Rek_4
 * @property integer $Kd_Rek_5
 * @property integer $D_Rek_1
 * @property integer $D_Rek_2
 * @property integer $D_Rek_3
 * @property integer $D_Rek_4
 * @property integer $D_Rek_5
 * @property integer $K_Rek_1
 * @property integer $K_Rek_2
 * @property integer $K_Rek_3
 * @property integer $K_Rek_4
 * @property integer $K_Rek_5
 */
class RefKorolari extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Korolari';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'D_Rek_1', 'D_Rek_2', 'D_Rek_3', 'D_Rek_4', 'D_Rek_5', 'K_Rek_1', 'K_Rek_2', 'K_Rek_3', 'K_Rek_4', 'K_Rek_5'], 'required'],
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'D_Rek_1', 'D_Rek_2', 'D_Rek_3', 'D_Rek_4', 'D_Rek_5', 'K_Rek_1', 'K_Rek_2', 'K_Rek_3', 'K_Rek_4', 'K_Rek_5'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'D_Rek_1' => 'D  Rek 1',
            'D_Rek_2' => 'D  Rek 2',
            'D_Rek_3' => 'D  Rek 3',
            'D_Rek_4' => 'D  Rek 4',
            'D_Rek_5' => 'D  Rek 5',
            'K_Rek_1' => 'K  Rek 1',
            'K_Rek_2' => 'K  Rek 2',
            'K_Rek_3' => 'K  Rek 3',
            'K_Rek_4' => 'K  Rek 4',
            'K_Rek_5' => 'K  Rek 5',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKorolariQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKorolariQuery(get_called_class());
    }
}
