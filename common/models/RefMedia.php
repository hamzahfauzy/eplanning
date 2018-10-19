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
 *
 * @property TaForumLingkunganMedia[] $taForumLingkunganMedia
 * @property TaMusrenbangKelurahanMedia[] $taMusrenbangKelurahanMedia
 * @property TaMusrenbangKelurahan[] $kdTaMusrenbangKelurahans
 * @property TaUsulanLingkunganMedia $taUsulanLingkunganMedia
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
            [['Jenis_Media', 'Type_Media', 'Judul_Media', 'Nm_Media', 'Created_At'], 'required'],
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
     * @return \yii\db\ActiveQuery
     */
    public function getTaForumLingkunganMedia()
    {
        return $this->hasMany(TaForumLingkunganMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaMusrenbangKelurahanMedia()
    {
        return $this->hasMany(TaMusrenbangKelurahanMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }
	
	public function getMusrenbangSkpdMedia()
    {
        return $this->hasMany(MusrenbangSkpdMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }

    /** 
     * @return \yii\db\ActiveQuery
     */
    public function getKdTaMusrenbangKelurahans()
    {
        return $this->hasMany(TaMusrenbangKelurahan::className(), ['Kd_Ta_Musrenbang_Kelurahan' => 'Kd_Ta_Musrenbang_Kelurahan'])->viaTable('Ta_Musrenbang_Kelurahan_Media', ['Kd_Media' => 'Kd_Media']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaUsulanLingkunganMedia()
    {
        return $this->hasOne(TaUsulanLingkunganMedia::className(), ['Kd_Media' => 'Kd_Media']);
    }

    /**
     * @inheritdoc
     * @return RefMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RefMediaQuery(get_called_class());
    }
}
