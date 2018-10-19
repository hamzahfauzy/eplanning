<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Jenis_Usulan".
 *
 * @property integer $Kd_Urusan
 * @property integer $Kd_Bidang
 * @property integer $Kd_Prog
 * @property integer $Kd_Keg
 * @property integer $Kd_Klasifikasi
 * @property string $Nm_Jenis_Usulan
 *
 * @property RefKegiatan $kdUrusan
 */
class RefJenisUsulan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Jenis_Usulan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Klasifikasi', 'Nm_Jenis_Usulan'], 'required'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Klasifikasi'], 'integer'],
            [['Nm_Jenis_Usulan'], 'string', 'max' => 255],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg'], 'exist', 'skipOnError' => true, 'targetClass' => RefKegiatan::className(), 'targetAttribute' => ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Prog' => 'Kd  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Klasifikasi' => 'Kd  Klasifikasi',
            'Nm_Jenis_Usulan' => 'Nm  Jenis  Usulan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusan()
    {
        return $this->hasOne(RefKegiatan::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefJenisUsulanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefJenisUsulanQuery(get_called_class());
    }
}
