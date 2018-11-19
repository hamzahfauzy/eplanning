<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ref_Kecamatan_Kriteria_Pembobotan".
 *
 * @property integer $Kd_Kriteria
 * @property string $Kriteria
 * @property integer $Bobot
 * @property string $Keterangan_Kriteria
 *
 * @property RefKecamatanKriteriaBobot[] $refKecamatanKriteriaBobots
 */
class RefKecamatanKriteriaPembobotan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ref_Kecamatan_Kriteria_Pembobotan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kriteria', 'Bobot'], 'required'],
            [['Bobot'], 'integer'],
            [['Keterangan_Kriteria'], 'string'],
            [['Kriteria'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Kriteria' => 'Kd  Kriteria',
            'Kriteria' => 'Kriteria',
            'Bobot' => 'Bobot',
            'Keterangan_Kriteria' => 'Keterangan  Kriteria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKecamatanKriteriaBobots()
    {
        return $this->hasMany(RefKecamatanKriteriaBobot::className(), ['Kd_Kriteria' => 'Kd_Kriteria']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\RefKecamatanKriteriaPembobotanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RefKecamatanKriteriaPembobotanQuery(get_called_class());
    }
}
