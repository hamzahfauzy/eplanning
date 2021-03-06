<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefMedia;

/**
 * This is the model class for table "Ta_Pokir_Media".
 *
 * @property string $Tahun
 * @property int $Kd_User
 * @property int $Kd_Media
 * @property string $Jenis_Dokumen
 *
 * @property RefMedia $kdUser
 */
class TaPokirMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pokir_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_User', 'Kd_Media', 'Jenis_Dokumen'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_User', 'Kd_Media'], 'integer'],
            [['Jenis_Dokumen'], 'string'],
            [['Kd_User'], 'exist', 'skipOnError' => true, 'targetClass' => RefMedia::className(), 'targetAttribute' => ['Kd_User' => 'Kd_Media']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_User' => 'Kd  User',
            'Kd_Media' => 'Kd  Media',
            'Jenis_Dokumen' => 'Jenis  Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUser()
    {
        return $this->hasOne(RefMedia::className(), ['Kd_Media' => 'Kd_User']);
    }
    
    public function getKdMedia()
    {
        return $this->hasOne(RefMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaPokirMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaPokirMediaQuery(get_called_class());
    }
}
