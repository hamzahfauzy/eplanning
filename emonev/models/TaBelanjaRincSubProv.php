<?php

namespace emonev\models;

use Yii;

/**
 * This is the model class for table "Ta_Belanja_Rinc_Sub_Prov".
 *
 * @property string $Tahun
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $Kd_Prog
 * @property int $ID_Prog
 * @property int $Kd_Keg
 * @property int $Kd_Rek_1
 * @property int $Kd_Rek_2
 * @property int $Kd_Rek_3
 * @property int $Kd_Rek_4
 * @property int $Kd_Rek_5
 * @property int $No_Rinc
 * @property int $No_ID
 * @property string $Sat_1
 * @property double $Nilai_1
 * @property string $Sat_2
 * @property double $Nilai_2
 * @property string $Sat_3
 * @property double $Nilai_3
 * @property string $Satuan123
 * @property double $Jml_Satuan
 * @property double $Nilai_Rp
 * @property double $Total
 * @property string $Keterangan
 * @property string $Asal_Biaya 1. ssh, 2. hspk, 3. asb
 * @property string $Uraian_Asal_Biaya serialize dari ssh atau asb
 * @property string $Ref_Usulan_Rincian dari usulan mana obyek di ambil. 1. lingkungan, 2. kelurahan, 3. kecamatan, 4. skpd, 5. pokir, 6. skpd, 7. musrenbang kota
 * @property string $Uraian_Ref_Usulan serialize dari asal obyek 
 *
 * @property TaBelanjaRincProv $tahun
 */
class TaBelanjaRincSubProv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Belanja_Rinc_Sub_Prov';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'No_ID', 'Satuan123', 'Jml_Satuan', 'Nilai_Rp', 'Total', 'Asal_Biaya'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'No_ID'], 'integer'],
            [['Nilai_1', 'Nilai_2', 'Nilai_3', 'Jml_Satuan', 'Nilai_Rp', 'Total'], 'number'],
            [['Asal_Biaya', 'Uraian_Asal_Biaya', 'Ref_Usulan_Rincian', 'Uraian_Ref_Usulan'], 'string'],
            [['Sat_1', 'Sat_2', 'Sat_3'], 'string', 'max' => 10],
            [['Satuan123'], 'string', 'max' => 50],
            [['Keterangan'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc'], 'exist', 'skipOnError' => true, 'targetClass' => TaBelanjaRincProv::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'No_Rinc' => 'No  Rinc',
            'No_ID' => 'No  ID',
            'Sat_1' => 'Sat 1',
            'Nilai_1' => 'Nilai 1',
            'Sat_2' => 'Sat 2',
            'Nilai_2' => 'Nilai 2',
            'Sat_3' => 'Sat 3',
            'Nilai_3' => 'Nilai 3',
            'Satuan123' => 'Satuan123',
            'Jml_Satuan' => 'Jml  Satuan',
            'Nilai_Rp' => 'Nilai  Rp',
            'Total' => 'Total',
            'Keterangan' => 'Keterangan',
            'Asal_Biaya' => 'Asal  Biaya',
            'Uraian_Asal_Biaya' => 'Uraian  Asal  Biaya',
            'Ref_Usulan_Rincian' => 'Ref  Usulan  Rincian',
            'Uraian_Ref_Usulan' => 'Uraian  Ref  Usulan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBelanjaRinc()
    {
        return $this->hasOne(TaBelanjaRincProv::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaBelanjaRincSubProvQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaBelanjaRincSubProvQuery(get_called_class());
    }

    public function getUrusan()
    {
        return $this->hasOne(\common\models\RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getBidang()
    {
        return $this->hasOne(\common\models\RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getUnit()
    {
        return $this->hasOne(\common\models\RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    public function getSub()
    {
        return $this->hasOne(\common\models\RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getProgram() 
    {
        return $this->hasOne(\common\models\RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    } 

    public function getKegiatan()
    {
        return $this->hasOne(\common\models\TaKegiatanProv::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getKdRek5()
    {
        return $this->hasOne(\common\models\RefRek5::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }
}
