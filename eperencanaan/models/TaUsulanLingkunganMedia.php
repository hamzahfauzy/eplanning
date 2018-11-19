<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefMedia;

/**
 * This is the model class for table "Ta_Usulan_Lingkungan_Media".
 *
 * @property integer $Kd_Media
 * @property integer $Kd_Ta_Forum_Lingkungan
 * @property string $Jenis_Dokumen
 *
 * @property TaForumLingkungan $kdTaForumLingkungan
 * @property RefMedia $kdMedia
 */
class TaUsulanLingkunganMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Usulan_Lingkungan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Media', 'Kd_Ta_Forum_Lingkungan', 'Jenis_Dokumen'], 'required'],
            [['Kd_Media', 'Kd_Ta_Forum_Lingkungan'], 'integer'],
            [['Jenis_Dokumen'], 'string'],
            [['Kd_Ta_Forum_Lingkungan'], 'exist', 'skipOnError' => true, 'targetClass' => TaForumLingkungan::className(), 'targetAttribute' => ['Kd_Ta_Forum_Lingkungan' => 'Kd_Ta_Forum_Lingkungan']],
            [['Kd_Media'], 'exist', 'skipOnError' => true, 'targetClass' => RefMedia::className(), 'targetAttribute' => ['Kd_Media' => 'Kd_Media']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Media' => 'Kd  Media',
            'Kd_Ta_Forum_Lingkungan' => 'Kd  Ta  Forum  Lingkungan',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdTaForumLingkungan()
    {
        return $this->hasOne(TaForumLingkungan::className(), ['Kd_Ta_Forum_Lingkungan' => 'Kd_Ta_Forum_Lingkungan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdMedia()
    {
        return $this->hasOne(RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }
}
