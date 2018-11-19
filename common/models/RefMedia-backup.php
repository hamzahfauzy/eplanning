<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Media".
 *
 * @property integer $Kd_Media
 * @property string $Jenis_Media
 * @property string $Type_Media
 * @property string $Judul_Media
 * @property string $Nm_Media
 * @property string $Created_At
 */
class RefMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Media', 'Jenis_Media', 'Type_Media', 'Judul_Media', 'Nm_Media', 'Created_At'], 'required'],
            [['Kd_Media'], 'integer'],
            [['Created_At'], 'safe'],
            [['Jenis_Media'], 'string', 'max' => 10],
            [['Type_Media'], 'string', 'max' => 20],
            [['Judul_Media', 'Nm_Media'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Media' => 'Kd  Media',
            'Jenis_Media' => 'Jenis  Media',
            'Type_Media' => 'Type  Media',
            'Judul_Media' => 'Judul  Media',
            'Nm_Media' => 'Nm  Media',
            'Created_At' => 'Created  At',
        ];
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefMediaQuery(get_called_class());
    }
}
