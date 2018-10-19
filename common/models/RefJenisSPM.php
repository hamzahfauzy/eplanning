<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Jenis_SPM".
 *
 * @property integer $Jn_SPM
 * @property string $Nm_Jn_SPM
 */
class RefJenisSPM extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Jenis_SPM';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jn_SPM', 'Nm_Jn_SPM'], 'required'],
            [['Jn_SPM'], 'integer'],
            [['Nm_Jn_SPM'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Jn_SPM' => 'Jn  Spm',
            'Nm_Jn_SPM' => 'Nm  Jn  Spm',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefJenisSPMQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefJenisSPMQuery(get_called_class());
    }
}
