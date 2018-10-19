<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Jurnal".
 *
 * @property integer $Kd_Jurnal
 * @property string $Nm_Jurnal
 */
class RefJurnal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Jurnal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Jurnal'], 'required'],
            [['Kd_Jurnal'], 'integer'],
            [['Nm_Jurnal'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Jurnal' => 'Kd  Jurnal',
            'Nm_Jurnal' => 'Nm  Jurnal',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefJurnalQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefJurnalQuery(get_called_class());
    }
}
