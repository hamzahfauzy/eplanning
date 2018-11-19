<?php

namespace eperencanaan\models;

use Yii;
use common\models\RefJalan;
use common\models\RefKabupaten;
use common\models\RefKecamatan;
use common\models\RefKelurahan;
use common\models\RefStandardSatuan;
use common\models\RefProvinsi;
use common\models\RefLingkungan;
use common\models\RefStatusUsulan;
/**
 * This is the model class for table "Ta_Musrenbang_Kelurahan_Media".
 *
 * @property integer $Kd_Musrenbang_Kelurahan
 * @property integer $Kd_Media
 */
class TaMusrenbangKelurahanMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Musrenbang_Kelurahan_Media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Musrenbang_Kelurahan', 'Kd_Media'], 'required'],
            [['Kd_Musrenbang_Kelurahan', 'Kd_Media'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Kd_Musrenbang_Kelurahan' => 'Kd  Musrenbang  Kelurahan',
            'Kd_Media' => 'Kd  Media',
        ];
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\query\TaMusrenbangKelurahanMediaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eperencanaan\models\query\TaMusrenbangKelurahanMediaQuery(get_called_class());
    }
}
