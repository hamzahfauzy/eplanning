<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Tahun".
 *
 * @property integer $Tahun
 * @property string $status
 */
class RefTahun extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Tahun';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'status'], 'required'],
            [['Tahun'], 'integer'],
            [['status'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefTahunQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefTahunQuery(get_called_class());
    }
}
