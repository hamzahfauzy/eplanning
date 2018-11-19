<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Forum_Lingkungan_Media".
 *
 * @property integer $Kd_Forum_Lingkungan
 * @property string $Jenis_Media
 * @property string $Type_Media
 * @property string $Judul_Media
 * @property string $Nm_Media
 * @property string $Created_at
 */
class TaForumLingkunganMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Forum_Lingkungan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Forum_Lingkungan', 'Jenis_Media', 'Type_Media', 'Judul_Media', 'Nm_Media', 'Created_at'], 'required'],
            [['Kd_Forum_Lingkungan'], 'integer'],
            [['Created_at'], 'safe'],
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
            'Kd_Forum_Lingkungan' => 'Kd  Forum  Lingkungan',
            'Jenis_Media' => 'Jenis  Media',
            'Type_Media' => 'Type  Media',
            'Judul_Media' => 'Judul  Media',
            'Nm_Media' => 'Nm  Media',
            'Created_at' => 'Created At',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaForumLingkunganMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaForumLingkunganMediaQuery(get_called_class());
    }
}
