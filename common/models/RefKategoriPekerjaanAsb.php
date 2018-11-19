<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Kategori_Pekerjaan_Asb".
 *
 * @property integer $Kd_Pekerjaan
 * @property string $Uraian
 *
 * @property TaHspkAsb[] $taHspkAsbs
 */
class RefKategoriPekerjaanAsb extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kategori_Pekerjaan_Asb';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Uraian'], 'required'],
            [['Uraian'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Pekerjaan' => 'Kd  Pekerjaan',
            'Uraian' => 'Uraian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaHspkAsbs()
    {
        return $this->hasMany(TaHspkAsb::className(), ['Kategori_Pekerjaan' => 'Kd_Pekerjaan']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKategoriPekerjaanAsbQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKategoriPekerjaanAsbQuery(get_called_class());
    }
}
